
@extends('layouts.master')
@section('css')
<!-- Internal Data table css -->
<link href="{{URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" />
<link href="{{URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css')}}" rel="stylesheet" />
<link href="{{URL::asset('assets/plugins/datatable/css/jquery.dataTables.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/datatable/css/responsive.dataTables.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
@endsection
@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h4 class="content-title mb-0 my-auto">Ayarlar</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ ürünler</span>
						</div>
					</div>

				</div>
				<!-- breadcrumb -->
@endsection
@section('title')
Ürünler
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
@if (session()->has('edit'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>{{ session()->get('edit') }}</strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif
@if (session()->has('delete'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>{{ session()->get('delete') }}</strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif
				<!-- row -->
				<div class="row">
				<div class="col-xl-12">
						<div class="card mg-b-20">
							<div class="card-header pb-0">


								<div class="d-flex justify-content-between">
								<a class="modal-effect btn btn-outline-primary btn-block" data-effect="effect-scale" data-toggle="modal" href="#exampleModal">Ürün ekleme</a>
								</div>
							</div>


							<div class="card-body">
								<div class="table-responsive">
									<table id="example1" class="table key-buttons text-md-nowrap" data-page-length='50'>
										<thead>
											<tr>
												<th class="border-bottom-0">#</th>
												<th class="border-bottom-0">Ürün ismi</th>
												<th class="border-bottom-0">Bölüm ismi</th>
												<th class="border-bottom-0">Notlar</th>
												<th class="border-bottom-0">Süreçler</th>


											</tr>
										</thead>
										<tbody>
											<?php $i=0 ?>
										@foreach($urunler as $x)
										<?php $i++?>
										<tr>
											<td>{{ $i }}</td>
                                            <td>{{ $x->urun_ismi }}</td>
											<td>{{ $x->bolumler->bolum_ismi }}</td>
											<td>{{ $x->tanim }}</td>
											<td>

											<button class="btn btn-outline-success btn-sm"
                                                data-urun_ismi="{{ $x->urun_ismi }}" data-pro_id="{{ $x->id }}"
												data-urun_id="{{ $x->id }}"
                                                data-bolum_ismi="{{ $x->bolumler->bolum_ismi }}"
                                                data-tanim="{{ $x->tanim }}" data-toggle="modal"
                                                data-target="#urun_duzenle">Düzenle</button>

												<button class="btn btn-outline-danger btn-sm " data-urun_id="{{ $x->id }}"
                                                data-urun_ismi="{{ $x->urun_ismi }}" data-toggle="modal"
                                                data-target="#modaldemo0">Sil</button>

											</td>
										</tr>
											@endforeach
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>





				</div>

				<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Ürün ekle </h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                    <form action="{{route('urunler.store')}}" method="post" autocomplete="off">
                                    {{csrf_field()}}
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Ürün ismi </label>
                                            <input type="text" class="form-control" id="urun_ismi" name="urun_ismi" required >

                                        </div>

                                        <label class="my-1 mr-2" for="inlineFormCustomSelectPref">Bölüm</label>
                                        <select name="bolum_id" id="bolum_id" class="form-control" required>
                                            <option value="" selected disabled> --Bölüm seç --</option>
                                            @foreach ($bolumler as $bolum)
                                                <option value="{{ $bolum->id }}">{{ $bolum->bolum_ismi }}</option>
                                            @endforeach
                                        </select>

                                        <div class="form-group">
                                            <label for="exampleFormControlTextarea1">Tanim</label>
                                            <textarea class="form-control" id="tanim" name="tanim" rows="3"></textarea>
                                        </div>

                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-success">Kayd et</button>
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Kapat</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
 <!-- edit -->
          <div class="modal fade" id="urun_duzenle" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel"> Ürün düzenleme</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">

                                        <form action="urunler/update" method="post" autocomplete="off">
                                            {{method_field('patch')}}
                                            {{csrf_field()}}
                                            <div class="form-group">
                                <label for="title">  Ürün ismi</label>

                                <input type="hidden" class="form-control" name="urun_id" id="urun_id" value="">

                                <input type="text" class="form-control" name="urun_ismi" id="urun_ismi">
                            </div>

                            <label class="my-1 mr-2" for="inlineFormCustomSelectPref">Bölüm</label>
                            <select name="bolum_ismi" id="bolum_ismi" class="custom-select my-1 mr-sm-2" required>
                                @foreach ($bolumler as $x)
                                    <option>{{ $x->bolum_ismi }}</option>
                                @endforeach
                            </select>

                            <div class="form-group">
                                <label for="des"> Notlar</label>
                                <textarea name="tanim" cols="20" rows="5" id='tanim'
                                    class="form-control"></textarea>
                            </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary">Düzenle</button>
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Kapat</button>
                                    </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        </div>





<!-- delete -->

                    <div class="modal" id="modaldemo0">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content modal-content-demo">
                                <div class="modal-header">
                                    <h6 class="modal-title">Ürün silme</h6><button aria-label="Close" class="close" data-dismiss="modal"
                                                                                   type="button"><span aria-hidden="true">&times;</span></button>
                                </div>
                                <form action="urunler/destroy" method="post" >
                                    {{method_field('delete')}}
                                    {{csrf_field()}}
                                    <div class="modal-body">
                                        <p>?Silme işleminden emin misiniz</p><br>
                                        <input type="hidden" name="urun_id" id="urun_id" value="">
                                        <input class="form-control" name="urun_ismi" id="urun_ismi" type="text" readonly>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Kapat</button>
                                        <button type="submit" class="btn btn-danger">Sil</button>
                                    </div>

                            </form>
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
<!-- Internal Data tables -->
<script src="{{URL::asset('assets/plugins/datatable/js/jquery.dataTables.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.dataTables.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/responsive.dataTables.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/jquery.dataTables.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.bootstrap4.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.buttons.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/buttons.bootstrap4.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/jszip.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/pdfmake.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/vfs_fonts.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/buttons.html5.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/buttons.print.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/buttons.colVis.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/responsive.bootstrap4.min.js')}}"></script>
<!--Internal  Datatable js -->
<script src="{{URL::asset('assets/js/table-data.js')}}"></script>

<script>
        $('#urun_duzenle').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var urun_ismi = button.data('urun_ismi')
            var bolum_ismi = button.data('bolum_ismi')
            var tanim = button.data('tanim')
			var urun_id = button.data('urun_id')

            var modal = $(this)
            modal.find('.modal-body #urun_ismi').val(urun_ismi);
            modal.find('.modal-body #bolum_ismi').val(bolum_ismi);
            modal.find('.modal-body #tanim').val(tanim);
			modal.find('.modal-body #urun_id').val(urun_id);

        })


        $('#modaldemo0').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var urun_id = button.data('urun_id')
            var urun_ismi = button.data('urun_ismi')
            var modal = $(this)

            modal.find('.modal-body #urun_id').val(urun_id);
            modal.find('.modal-body #urun_ismi').val(urun_ismi);
        })


    </script>
@endsection
