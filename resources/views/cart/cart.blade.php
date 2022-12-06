@extends('landingpage.index')
@section('content')
  <section id="login" class="login" style="background: #1a1814">
    <div class="container">
      <div>
        {{-- <div class="row">
          <div class="col-md-9 px-5"> --}}
            <table class="table text-white table-borderless text-center align-middle" id="cart">
              <thead class="text-muted">
                <tr>
                  <td class="text-start px-0" style="width:150px"></td>
                  <td class="text-start px-0">Detail Menu</td>
                  <td>Harga</td>
                  <td>Quantity</td>
                  <td>Subtotal</td>
                  <td></td>
                </tr>
              </thead>
              <tbody class="rounded-3">
                @php $total = 0 @endphp
                @if (session('cart'))
                  @foreach (session('cart') as $id => $details)
                    @php $total += $details['harga'] * $details['quantity'] @endphp
                    <tr data-id="{{ $id }}" class="">
                      <td>
                        @empty($details['foto'])
                          <img src="{{ url('/public/assets/img/menu/placeholder.jpg') }}"width="100" class="img-responsive rounded-3 float-start px-0"/>
                        @else
                          <img src="{{ url('/public/assets/img/menu') }}/{{ $details['foto'] }}" width="100" class="img-responsive rounded-3 float-start px-0"/>
                        @endempty
                      </td>
                      <td class="text-start px-0 fw-bold">{{ $details['nama'] }}
                      </td>
                      <td>Rp {{ number_format($details['harga'], 0, ',', '.') }}</td> 
                      <td>
                        <button class="btn minus text-white border-0"><i class="fa fa-minus"></i></button>
                        <input type="text" value="{{ $details['quantity'] }}" class="quantity update-cart text-center px-0 rounded-3"/>
                        <button class="btn plus text-white border-0"><i class="fa fa-plus"></i></button>
                      </td>
                      <td data-th="Subtotal">Rp {{ number_format($details['harga'] * $details['quantity'], 0, ',', '.') }}</td>
                      <td class="text-end align-middle"><button class="btn remove-from-cart text-tiny btn-dark border-0 rounded-circle" title="Delete"><i class="fa fa-times"></i></button></td>
                    </tr>
                  @endforeach
                @endif
              </tbody>
            </table>
            <div class="w-100 mt-5">
              <div class="d-flex justify-content-between">
                <div class="d-flex flex-row">
                  <span class="text-secondary align-self-center me-2">Total Cost: </span>
                  <span class="fs-4 text-white fw-bolder align-self-center">&nbsp;Rp {{ number_format($total, 0, ',', '.') }}</span>
                </div>
                <div class="d-flex justify-content-between w-25">
                  <a href="{{ url('/menu') }}" class="btn btn-outline-light p-3 border-0 text-uppercase"><i class="fa fa-chevron-left me-2"></i>Lanjut Belanja</a>
                  @if (Auth::check())
                    @empty($ar_reservasi)
                      <button onclick="location.href='{{ url('/reservasi') }}'" class="btn btn-dark p-3">Checkout</button>
                    @else
                      @if ($ar_reservasi->status == 'approved')
                        <button onclick="location.href='#'" class="btn btn-dark p-3">Checkout</button>
                      @elseif ($ar_reservasi->status == 'pending')
                        <button onclick="errorSweetAlert()" class="btn btn-dark p-3">Checkout</button>
                      @else
                        <button onclick="location.href='{{ url('/reservasi') }}'" class="btn btn-dark p-3">Checkout</button>
                      @endif
                    @endempty
                    {{-- @if ($ar_reservasi->status == 'pending')
                      <button onclick="errorSweetAlert()" class="btn btn-dark p-3">Checkout</button> --}}
                    {{-- @elseif ($ar_reservasi->status == 'success')
                      <button onclick="errorSweetAlert()" class="btn btn-dark p-3">Checkout</button> --}}
                    {{-- @else
                      P
                    @endif --}}
                    {{-- <button onclick="errorSweetAlert()" class="btn btn-dark p-3">Checkout</button> --}}
                  @else
                    <a href="{{ url('/login') }}" class="btn btn-dark p-3">Checkout</a>
                  @endif
                </div>
              </div> 
            </div>
          </div>
          {{-- <div class="col-md-3">
            <div class="p-5 h-100 rounded-3 bg-dark">
              <div class="d-flex flex-column bd-highlight mb-3 h-100">
                <div class="border border-2"></div>
                <div class="d-flex justify-content-center mt-5">
                  <span class="text-tiny mt-auto me-3">TOTAL </span><span class="fw-bold ">&nbsp;Rp {{ number_format($total, 0, ',', '.') }}</span> 
                </div>
                <div class="d-flex justify-content-center mt-auto bd-highlight">
                  @if (Auth::check())
                  <button class="btn btn-success">Checkout</button>
                @else
                  <a href="{{ url('/login') }}" class="btn btn-success">Checkout</a>
                @endif
                </div>
              </div>
            </div>
          </div> --}}
        {{-- </div>
      </div> --}}
    </div>
  </section>
@endsection
@section('scripts')
  <script type="text/javascript">
    $(".update-cart").change(function(e) {
      e.preventDefault();
      var ele = $(this);
      $.ajax({
        url: '{{ route('update.cart') }}',
        method: "patch",
        data: {
          _token: '{{ csrf_token() }}',
          id: ele.parents("tr").attr("data-id"),
          quantity: ele.parents("tr").find(".quantity").val()
        },
        success: function(response) {
          window.location.reload();
        }
      });
    });
    $(".remove-from-cart").click(function(e) {
      e.preventDefault();
      var ele = $(this);
      if (confirm("Are you sure want to remove?")) {
        $.ajax({
          url: '{{ route('remove.from.cart') }}',
          method: "DELETE",
          data: {
            _token: '{{ csrf_token() }}',
            id: ele.parents("tr").attr("data-id")
          },
          success: function(response) {
            window.location.reload();
          }
        });
      }
    });
    $(document).ready(function() {
			$('.minus').click(function () {
				var $input = $(this).parent().find('input');
				var count = parseInt($input.val()) - 1;
				count = count < 1 ? 1 : count;
				$input.val(count);
				$input.change();
				return false;
			});
			$('.plus').click(function () {
				var $input = $(this).parent().find('input');
				$input.val(parseInt($input.val()) + 1);
				$input.change();
				return false;
			});
		});
    function errorSweetAlert() {
      Swal.fire(
        'Gagal',
        'Reservasi Anda Belum Diverifikasi!',
        'error'
      )
    }
  </script>
@endsection
