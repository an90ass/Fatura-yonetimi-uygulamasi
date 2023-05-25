@extends('layouts.master')
@section('css')
<style>
    @media print {
        #print_Button {
            display: none;
        }
    }
</style>
@endsection
@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h4 class="content-title mb-0 my-auto">Faturalar</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ Fatura baskı önizleme
                            </span>
						</div>
					</div>

				</div>
				<!-- breadcrumb -->
@endsection
@section('title')
Fatura yazdırma
@stop
@section('content')
				<!-- row -->
				<div class="row row-sm">
					<div class="col-md-12 col-xl-12">
						<div class=" main-content-body-invoice" id ="print">
							<div class="card card-invoice">
								<div class="card-body">
									<div class="invoice-header">
										<h1 class="invoice-title">Tahsilat faturası</h1>

									</div><!-- invoice-header -->
                                    <div class="col-md">
                                        <label class="tx-gray-600"> Fatura Bilgileri</label>
                                        <p class="invoice-info-row"><span> Fatura numarası</span>
                                            <span>{{ $faturalars->fatura_numarasi }}</span></p>
                                        <p class="invoice-info-row"><span> Fatura tarihi</span>
                                            <span>{{ $faturalars->fatura_Tarihi }}</span></p>
                                        <p class="invoice-info-row"><span>Fatura ödeme tarihi </span>
                                            <span>{{ $faturalars->Due_date }}</span></p>
                                        <p class="invoice-info-row" style="color:red"><span>Bölüm</span>
                                            <span>{{ $faturalars->bolumler->bolum_ismi }}</span></p>
                                    </div>
									</div>
									<div class="table-responsive mg-t-40">
										<table class="table table-invoice border text-md-nowrap mb-0">
											<thead>
												<tr>
                                                    <th class="wd-20p">#</th>
                                                    <th class="wd-40p">Ürün</th>
                                                    <th class="tx-center">Tahsilat tutarı </th>
                                                    <th class="tx-right">Komisyon tutarı </th>
                                                    <th class="tx-right">Toplam</th>
												</tr>
											</thead>
											<tbody>
												<tr>
                                                    <td>1</td>
                                                    <td class="tx-12">{{ $faturalars->urun }}</td>
                                                    <td class="tx-center">{{ number_format($faturalars->Tahsilat_tutari, 2) }}</td>
                                                    <td class="tx-right">{{ number_format($faturalars->Komisyon_tutari, 2) }}</td>
                                                    @php
                                                    $toplam = $faturalars->Tahsilat_tutari + $faturalars->Komisyon_tutari ;
                                                    @endphp
                                                    <td class="tx-right">
                                                        {{ number_format($toplam, 2) }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="valign-middle" colspan="2" rowspan="4">
                                                        <div class="invoice-notes">

                                                        </div><!-- invoice-notes -->
                                                    </td>
                                                    <td class="tx-right">Toplam</td>
                                                    <td class="tx-right" colspan="2"> {{ number_format($toplam, 2) }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="tx-right">Vergi oranı  </td>
                                                    <td class="tx-right" colspan="2"> ({{ $faturalars->KDV_orani }})</td>

                                                </tr>
                                                <tr>
                                                    <td class="tx-right">Kesilen tutar</td>
                                                    <td class="tx-right" colspan="2"> {{ number_format($faturalars->indirim, 2) }}</td>

                                                </tr>
                                                <tr>
                                                    <td class="tx-right tx-uppercase tx-bold tx-inverse"> Vergi dahil toplam</td>
                                                    <td class="tx-right" colspan="2">
                                                        <h4 class="tx-primary tx-bold">{{ number_format($faturalars->Toplam, 2) }}</h4>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <hr class="mg-b-40">



                                    <button class="btn btn-danger  float-left " id="print_Button" onclick="printDiv()"> <i
                                            class="mdi mdi-printer ml-1"></i>Yazdır</button>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- COL-END -->
                        </div>
                        <!-- row closed -->
                        </div>
                        <!-- Container closed -->
                        </div>
                        <!-- main-content closed -->
                    @endsection
                    @section('js')
                        <!--Internal  Chart.bundle js -->
                        <script src="{{ URL::asset('assets/plugins/chart.js/Chart.bundle.min.js') }}"></script>


                        <script type="text/javascript">
                            function printDiv() {
                                var printContents = document.getElementById('print').innerHTML;
                                var originalContents = document.body.innerHTML;
                                document.body.innerHTML = printContents;
                                window.print();
                                document.body.innerHTML = originalContents;
                                location.reload();
                            }
                        </script>

                    @endsection
