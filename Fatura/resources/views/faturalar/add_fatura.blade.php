@extends('layouts.master')
@section('css')
@endsection
@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h4 class="content-title mb-0 my-auto">Faturalar listesi</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ fatura ekle</span>
						</div>
					</div>

				</div>
				<!-- breadcrumb -->
@endsection
@section('title')
     Fatura ekleme
@stop
@section('content')
@if (session()->has('Add'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>{{ session()->get('Add') }}</strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif
				<!-- row -->
				<div class="row">

				<div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('faturalars.store') }}" method="post" enctype="multipart/form-data"
                        autocomplete="off">
                                            {{csrf_field()}}
                        {{-- 1 --}}

						<div class="row">
                            <div class="col">
                                <label for="inputName" class="control-label"> Fatura Numarası</label>
                                <input type="text" class="form-control" id="inputName" name="fatura_numarasi"
                                    title="Lütfen fatura numarası girin"required>
                            </div>
							<div class="col">
                                <label> Fatura tarihi</label>
                                <input class="form-control fc-datepicker" name="fatura_tarihi" placeholder="YYYY-MM-DD"
                                    type="text" value="{{ date('Y-m-d') }}" required>
                            </div>


                            <div class="col">
                                <label>Son ödeme tarihi </label>
                                <input class="form-control fc-datepicker" name="due_tarihi" placeholder="YYYY-MM-DD"
                                    type="text" required>
                            </div>

							</div>

							{{-- 2 --}}
                        <div class="row">
                            <div class="col">
                            <label for="inputName" class="control-label">Bölüm</label>
                                <select name="bolum" class="form-control SelectBox" onclick="console.log($(this).val())"
                                    onchange="console.log('change is firing')">
                                    <!--placeholder-->
                                    <option value="" selected disabled> Bölüm seç</option>
                                    @foreach ($bolumler as $x)
                                        <option value="{{ $x->id }}"> {{ $x->bolum_ismi }}</option>
                                    @endforeach
                                </select>
                        </div>

                        <div class="col">
                            <label for="inputName" class="control-label">Ürün</label>
                            <select name="urun" class="form-control SelectBox"></select>
                          </div>



                            <div class="col">
                                <label for="inputName" class="control-label">Tahsilat tutari </label>
                                <input type="text" class="form-control" id="inputName" name="Tahsilat_tutari"
                                    oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
                            </div>
                        </div>


                        {{-- 3 --}}

                        <div class="row">

                            <div class="col">
                                <label for="inputName" class="control-label"> Komisyon tutarı</label>
                                <input type="text" class="form-control form-control-lg" id="Komisyon_tutari"
                                    name="Komisyon_tutari" title="Lütfen Komisyon tutarı giriniz"
                                    oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                                    required>
                            </div>

                            <div class="col">
                                <label for="inputName" class="control-label">Kesilen tutar</label>
                                <input type="text" class="form-control form-control-lg" id="kesilen_tutar" name="kesilen_tutar"
                                    title="Lütfen kesilen tutarı giriniz"
                                    oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                                    value=0 required>
                            </div>

                            <div class="col">
                                <label for="inputName" class="control-label">KDV oranı</label>
                                <select name="KDV_orani" id="KDV_orani" class="form-control" onchange="myFunction()">
                                    <!--placeholder-->
                                    <option value="" selected disabled>Vergi oranını belirleyin  </option>
                                    <option value=" 5%">5%</option>
                                    <option value="10%">10%</option>
                                </select>
                            </div>

                        </div>

                        {{-- 4 --}}

                        <div class="row">
                            <div class="col">
                                <label for="inputName" class="control-label">   KDV tutarı</label>
                                <input type="text" class="form-control" id="KDV_tutari" name="KDV_tutari" readonly>
                            </div>

                            <div class="col">
                                <label for="inputName" class="control-label">  Vergi dahil toplam</label>
                                <input type="text" class="form-control" id="toplam" name="toplam" readonly>
                            </div>
                        </div>

                        {{-- 5 --}}
                        <div class="row">
                            <div class="col">
                                <label for="exampleTextarea">Notlar</label>
                                <textarea class="form-control" id="exampleTextarea" name="note" rows="3"></textarea>
                            </div>
                        </div><br>

                        <p class="text-danger">*Ek biçimi*  pdf, jpeg ,.jpg , png </p>
                        <h5 class="card-title">Ekeler</h5>

                        <div class="col-sm-12 col-md-12">
                            <input type="file" name="pic"  accept=".pdf,.jpg, .png, image/jpeg, image/png"
                                data-height="70" />
                        </div>



                        <div class="d-flex justify-content-center">
                            <button type="submit" class="btn btn-primary">Bilgileri kaydet </button>
                        </div>


                    </form>
                </div>
            </div>
        </div>
    </div>

    </div>
				<!-- row closed -->
			</div>
			<!-- Container closed -->
		</div>
		<!-- main-content closed -->
@endsection
@section('js')
    <!-- Internal Select2 js-->
    <script src="{{ URL::asset('assets/plugins/select2/js/select2.min.js') }}"></script>
    <!--Internal Fileuploads js-->
    <script src="{{ URL::asset('assets/plugins/fileuploads/js/fileupload.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/fileuploads/js/file-upload.js') }}"></script>
    <!--Internal Fancy uploader js-->
    <script src="{{ URL::asset('assets/plugins/fancyuploder/jquery.ui.widget.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/fancyuploder/jquery.fileupload.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/fancyuploder/jquery.iframe-transport.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/fancyuploder/jquery.fancy-fileupload.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/fancyuploder/fancy-uploader.js') }}"></script>
    <!--Internal  Form-elements js-->
    <script src="{{ URL::asset('assets/js/advanced-form-elements.js') }}"></script>
    <script src="{{ URL::asset('assets/js/select2.js') }}"></script>
    <!--Internal Sumoselect js-->
    <script src="{{ URL::asset('assets/plugins/sumoselect/jquery.sumoselect.js') }}"></script>
    <!--Internal  Datepicker js -->
    <script src="{{ URL::asset('assets/plugins/jquery-ui/ui/widgets/datepicker.js') }}"></script>
    <!--Internal  jquery.maskedinput js -->
    <script src="{{ URL::asset('assets/plugins/jquery.maskedinput/jquery.maskedinput.js') }}"></script>
    <!--Internal  spectrum-colorpicker js -->
    <script src="{{ URL::asset('assets/plugins/spectrum-colorpicker/spectrum.js') }}"></script>
    <!-- Internal form-elements js -->
    <script src="{{ URL::asset('assets/js/form-elements.js') }}"></script>


    <script>
        var date = $('.fc-datepicker').datepicker({
            dateFormat: 'yy-mm-dd'
        }).val();
    </script>


    <script>
    $(document).ready(function() {
    $('select[name="bolum"]').on('change', function() {
        var bolumId = $(this).val();
        if (bolumId) {
            $.ajax({
                url: "{{ url('bolum') }}/" + bolumId,
                                type: "GET",
                dataType: "json",
                success: function(response) {
    $('select[name="urun"]').html(response.options);
}
            });
        } else {
            console.log('AJAX load did not work');
        }
    });
});


    </script>

<script>
        function myFunction() {
            var Komisyon_tutari = parseFloat(document.getElementById("Komisyon_tutari").value);
            var kesilen_tutar = parseFloat(document.getElementById("kesilen_tutar").value);
            var KDV_orani = parseFloat(document.getElementById("KDV_orani").value);
            var KDV_tutari = parseFloat(document.getElementById("KDV_tutari").value);
            var Komisyon_tutari2 = Komisyon_tutari - kesilen_tutar;
            if (typeof Komisyon_tutari === 'undefined' || !Komisyon_tutari) {
                alert('  Lütfen Komisyon tutarı giriniz');
            } else {
                var intResults = Komisyon_tutari2 * KDV_orani / 100;
                var intResults2 = parseFloat(intResults + Komisyon_tutari2);
                sumq = parseFloat(intResults).toFixed(2);
                sumt = parseFloat(intResults2).toFixed(2);
                document.getElementById("KDV_tutari").value = sumq;
                document.getElementById("toplam").value = sumt;
            }
        }
    </script>





@endsection
