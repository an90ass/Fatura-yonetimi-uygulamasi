@extends('layouts.master')
@section('css')
<!-- Internal Data table css -->
<link href="{{URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" />
<link href="{{URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css')}}" rel="stylesheet" />
<link href="{{URL::asset('assets/plugins/datatable/css/jquery.dataTables.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/datatable/css/responsive.dataTables.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
 <!--Internal   Notify -->
 <link href="{{ URL::asset('assets/plugins/notify/css/notifIt.css') }}" rel="stylesheet" />
@endsection
@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h4 class="content-title mb-0 my-auto">Faturalar</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ ödenmiş faturalar </span>
						</div>
					</div>
					<div class="d-flex my-xl-auto right-content">

					</div>
				</div>
				<!-- breadcrumb -->
@endsection
@section('title')
Ödenmiş Faturalar
@stop
@section('content')
@if (session()->has('delete_fatura'))
        <script>
            window.onload = function() {
                notif({
                    msg: "Fatura başarıyla silindi",
                    type: "success"
                })
            }
        </script>
    @endif
    @if (session()->has('Durum_Update'))
        <script>
            window.onload = function() {
                notif({
                    msg: " Ödeme durumu başarıyla değiştirilmiş",
                    type: "success"
                })
            }
        </script>
    @endif
				<!-- row -->
				<div class="row">


					<div class="col-xl-12">
						<div class="card mg-b-20">
							<div class="card-header pb-0">





							<div class="card-body">
								<div class="table-responsive">
									<table id="example1" class="table key-buttons text-md-nowrap">
										<thead>
											<tr>
												<th class="border-bottom-0">#</th>
												<th class="border-bottom-0">Fatura Numarası</th>
												<th class="border-bottom-0">Fatura Tarihi</th>
												<th class="border-bottom-0"> Son ödeme tarihi</th>
												<th class="border-bottom-0">Ürün</th>
												<th class="border-bottom-0">Bölüm</th>
												<th class="border-bottom-0">indirim</th>
												<th class="border-bottom-0">vergi oranı</th>
												<th class="border-bottom-0">vergi değeri</th>

												<th class="border-bottom-0">Toplam</th>
												<th class="border-bottom-0">durum</th>
												<th class="border-bottom-0">yorumlar</th>
                                                <th class="border-bottom-0">Süreçler</th>

											</tr>
										</thead>
										<tbody>
											<?php
											$i = 0         ?>
											@foreach($faturalars as $x)
											<?php
											$i++        ?>
											<tr>
												<td>{{ $i }}</td>
												<td>{{ $x->fatura_numarasi }}</td>
												<td>{{ $x->fatura_Tarihi }}</td>
												<td>{{ $x->Due_date }}</td>
												<td>{{ $x->urun }}</td>
												<td><a
                                                href="{{ url('FaturalarDetails') }}/{{ $x->id }}">{{ $x->bolumler->bolum_ismi }}</a>
                                        </td>
												<td>{{ $x->indirim  }}</td>
												<td> {{ $x->KDV_orani  }}</td>
												<td>{{ $x->KDV_tutari  }}</td>
												<td>{{ $x->Toplam  }}</td>
												<td>
												@if ($x->Value_durum == 1)
                                                <span class="text-success">{{ $x->durum }}</span>
                                            @elseif($x->Value_durum == 2)
                                                <span class="text-danger">{{ $x->durum }}</span>
                                            @else
                                                <span class="text-warning">{{  $x->durum }}</span>
                                            @endif
												</td>
												<td>{{ $x->note  }} </td>

                                                <td>
                                                    <div class="dropdown">
                                                        <button aria-expanded="false" aria-haspopup="true"
                                                            class="btn ripple btn-primary btn-sm" data-toggle="dropdown"
                                                            type="button">Süreçler<i class="fas fa-caret-down ml-1"></i></button>
                                                        <div class="dropdown-menu tx-13">

                                                                <a class="dropdown-item"
                                                                    href=" {{ url('edit_fatura') }}/{{ $x->id }}">
                                                                    <i class="fas fa-pen"></i>
                                                                    Fatura düzenleme</a>


                                                                    <a class="dropdown-item" href="#" data-fatura_id="{{ $x->id }}"
                                                                        data-toggle="modal" data-target="#delete_fatura"><i
                                                                            class="text-danger fas fa-trash-alt"></i>&nbsp;&nbsp;
                                                                        Fatura silme</a>

                                                                        <a class="dropdown-item"
                                                                        href="{{ url('Durumu_goster') }}/{{ $x->id }}"><i
                                                                            class="fas fa-sync-alt"></i>&nbsp;&nbsp;
                                                                            Ödeme durumu değiştirme</a>

                                                                </div>
                                                            </div>

                                                        </td>
                                                    </tr>

											@endforeach


										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
					<!--/div-->

					<!--div-->
					</div>
				</div>
				<!-- /row -->
				</div>
				<!-- row closed -->
			</div>
			<!-- Container closed -->
		</div>
		<!-- main-content closed -->

         <!-- حذف الفاتورة -->
    <div class="modal fade" id="delete_fatura" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Fatura silme </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <form action="{{ url('faturalars/destroy') }}" method="post">
                    {{ method_field('delete') }}
                    {{ csrf_field() }}
            </div>
            <div class="modal-body">
                ? Fatura silme işleminden emin misiniz
                            <input type="hidden" name="fatura_id" id="fatura_id" value="">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">İptal</button>
                <button type="submit" class="btn btn-danger">Sil</button>
            </div>
            </form>
        </div>
    </div>
</div>
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
 <!--Internal  Notify js -->
 <script src="{{ URL::asset('assets/plugins/notify/js/notifIt.js') }}"></script>
 <script src="{{ URL::asset('assets/plugins/notify/js/notifit-custom.js') }}"></script>




@endsection
