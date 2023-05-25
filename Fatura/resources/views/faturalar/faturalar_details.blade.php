@extends('layouts.master')
@section('css')
    <!---Internal  Prism css-->
    <link href="{{ URL::asset('assets/plugins/prism/prism.css') }}" rel="stylesheet">
    <!---Internal Input tags css-->
    <link href="{{ URL::asset('assets/plugins/inputtags/inputtags.css') }}" rel="stylesheet">
    <!--- Custom-scroll -->
    <link href="{{ URL::asset('assets/plugins/custom-scroll/jquery.mCustomScrollbar.css') }}" rel="stylesheet">
@endsection
@section('title')
     Fatura detayları
@stop
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto"> faturalar listesi</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/
                     fatura detayları</span>
            </div>
        </div>

    </div>
    <!-- breadcrumb -->
@endsection
@section('content')


    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif


    @if (session()->has('Add'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{ session()->get('Add') }}</strong>
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



    <!-- row opened -->
    <div class="row row-sm">

        <div class="col-xl-12">
            <!-- div -->
            <div class="card mg-b-20" id="tabs-style2">
                <div class="card-body">
                    <div class="text-wrap">
                        <div class="example">
                            <div class="panel panel-primary tabs-style-2">
                                <div class=" tab-menu-heading">
                                    <div class="tabs-menu1">
                                        <!-- Tabs -->
                                        <ul class="nav panel-tabs main-nav-line">
                                            <li><a href="#tab4" class="nav-link active" data-toggle="tab">Fatura
                                                    bilgileri</a></li>
                                            <li><a href="#tab5" class="nav-link" data-toggle="tab"> Ödeme durumları</a></li>

                                            <li><a href="#tab6" class="nav-link" data-toggle="tab">Ekler</a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="panel-body tabs-menu-body main-content-body-right border">
                                    <div class="tab-content">


                                        <div class="tab-pane active" id="tab4">
                                            <div class="table-responsive mt-15">

                                                <table class="table table-striped" style="text-align:center">
                                                    <tbody>
                                                    <tr>
                                                            <th scope="row">Fatura numarası </th>
                                                            <td>{{ $faturalar->fatura_numarasi }}</td>
                                                            <th scope="row">Fatura tarihi </th>
                                                            <td>{{ $faturalar->fatura_Tarihi }}</td>
                                                            <th scope="row">Son ödeme tarihi </th>
                                                            <td>{{ $faturalar->Due_date }}</td>
                                                            <th scope="row">Bölüm</th>
                                                            <td>{{ $faturalar->bolumler->bolum_ismi }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row">Ürün</th>
                                                            <td>{{ $faturalar->urun }}</td>
                                                            <th scope="row">Tahsilat tutari </th>
                                                            <td>{{ $faturalar->Tahsilat_tutari }}</td>
                                                            <th scope="row"> Komisyon tutarı</th>
                                                            <td>{{ $faturalar->Komisyon_tutari }}</td>
                                                            <th scope="row">Kesiler tutar</th>
                                                            <td>{{ $faturalar->indirim }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row">KDV oranı </th>
                                                            <td>{{ $faturalar->KDV_orani }}</td>
                                                            <th scope="row"> KDV tutarı</th>
                                                            <td>{{ $faturalar->KDV_tutari }}</td>
                                                            <th scope="row"> Vergi dahil toplam </th>
                                                            <td>{{ $faturalar->Toplam }}</td>
                                                            <th scope="row"> Son durum</th>

                                                            @if ($faturalar->Value_durum == 1)
                                                                <td><span
                                                                        class="badge badge-pill badge-success">{{ $faturalar->durum }}</span>
                                                                </td>
                                                            @elseif($faturalar->Value_durum ==2)
                                                                <td><span
                                                                        class="badge badge-pill badge-danger">{{ $faturalar->durum }}</span>
                                                                </td>
                                                            @else
                                                                <td><span
                                                                        class="badge badge-pill badge-warning">{{ $faturalar->durum }}</span>
                                                                </td>
                                                            @endif
                                                        </tr>
                                                        <tr>
                                                            <th scope="row">Notlar</th>
                                                            <td>{{ $faturalar->note }}</td>
                                                        </tr>
                                                    </tbody>
                                                </table>

                                                </div>
                                        </div>


                                        <div class="tab-pane active" id="tab5">
                                            <div class="table-responsive mt-15">
                                                <table class="table center-aligned-table mb-0 table-hover"
                                                    style="text-align:center">
                                                    <thead>
                                                        <tr class="text-dark">
                                                            <th>#</th>
                                                            <th>Fatura numarası </th>
                                                            <th>Ürün türü </th>
                                                            <th>Bölüm</th>
                                                            <th>Ödeme durumu </th>
                                                            <th> Ödeme tarihi </th>
                                                            <th>Notlar</th>
                                                            <th> Ekleme tarihi </th>
                                                            <th>Kullancı</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    <?php $i = 0; ?>
                                                        @foreach ($details as $x)
                                                            <?php $i++; ?>
                                                            <tr>
                                                                <td>{{ $i }}</td>
                                                                <td>{{ $x->fatura_numarasi }}</td>
                                                                <td>{{ $x->urun }}</td>
                                                                <td>{{ $faturalar->bolumler->bolum_ismi }}</td>
                                                                @if ($x->value_durumu == 1)
                                                                    <td><span
                                                                            class="badge badge-pill badge-success">{{ $x->Durum }}</span>
                                                                    </td>
                                                                @elseif($x->value_durumu ==2)
                                                                    <td><span
                                                                            class="badge badge-pill badge-danger">{{ $x->Durum }}</span>
                                                                    </td>
                                                                @else
                                                                    <td><span
                                                                            class="badge badge-pill badge-warning">{{ $x->Durum }}</span>
                                                                    </td>
                                                                @endif
                                                                <td>{{ $x->odeme_tarihi }}</td>
                                                                <td>{{ $x->note }}</td>
                                                                <td>{{ $x->created_at }}</td>
                                                                <td>{{ $x->kullanci }}</td>
                                                            </tr>
                                                        @endforeach
                                                        </tbody>
                                                </table>


                                            </div>
                                        </div>
                                      <div class="tab-pane" id="tab6">
                                        <div class="card card-statistics">

                                                <div class="card-body">
                                                    <p class="text-danger">* Ekler biçimi  pdf, jpeg ,.jpg , png </p>
                                                    <h5 class="card-title"> Dosyalar ekleme</h5>
                                                    <form method="post" action="{{ url('/FaturaAttachments') }}"
                                                        enctype="multipart/form-data">
                                                        {{ csrf_field() }}
                                                        <div class="custom-file">
                                                            <input type="file" class="custom-file-input" id="customFile"
                                                                name="file_name" required>
                                                            <input type="hidden" id="customFile" name="fatura_numarasi"
                                                                value="{{ $faturalar->fatura_numarasi }}">

                                                            <input type="hidden" id="fatura_id" name="fatura_id"
                                                                value="{{ $faturalar->id }}">
                                                            <label class="custom-file-label" for="customFile">Dosya seç
                                                                </label>
                                                        </div><br><br>
                                                        <button type="submit" class="btn btn-primary btn-sm "
                                                            name="uploadedFile">Ekle</button>
                                                    </form>
                                                </div>
                                            <br>
                                            <div class="table-responsive mt-15">
                                                    <table class="table center-aligned-table mb-0 table table-hover"
                                                        style="text-align:center">
                                                        <thead>
                                                            <tr class="text-dark">
                                                                <th scope="col">#</th>
                                                                <th scope="col">Dosay adı </th>
                                                                <th scope="col">Ekleme yapmış </th>
                                                                <th scope="col">Ekleme tarihi </th>
                                                                <th scope="col">Süreçler</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>

                                                        <?php $i = 0; ?>
                                                            @foreach ($attachments as $s)
                                                                <?php $i++; ?>
                                                                <tr>
                                                                    <td>{{ $i }}</td>
                                                                    <td>{{ $s->file_name }}</td>
                                                                    <td>{{ $s->Tarafindan_yaratildi }}</td>
                                                                    <td>{{ $s->created_at }}</td>
                                                                    <td colspan="2">


                                                                            <a class="btn btn-outline-success btn-sm"
                                                                                href="{{ url('View_file') }}/{{ $faturalar->fatura_numarasi   }}/{{ $s->file_name }}"
                                                                                role="button"><i class="fas fa-eye"></i>&nbsp;
                                                                                Göster</a>

                                                                            <a class="btn btn-outline-info btn-sm"
                                                                                href="{{ url('download') }}/{{ $faturalar->fatura_numarasi }}/{{ $s->file_name }}"
                                                                                role="button"><i
                                                                                    class="fas fa-download"></i>&nbsp;
                                                                                İndir</a>


                                                                                <button class="btn btn-outline-danger btn-sm"
                                                                                    data-toggle="modal"
                                                                                    data-file_name="{{ $s->file_name }}"
                                                                                    data-fatura_numarasi="{{ $s->fatura_numarasi }}"
                                                                                    data-id_file="{{ $s->id }}"
                                                                                    data-target="#delete_file">Sil</button>


                                                                        </td>
                                                                    </tr>
                                                                @endforeach
                                                            </tbody>
                                                            </tbody>
                                                        </table>

                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /div -->
            </div>

        </div>

            <!-- /div -->

    <!-- /row -->


     <!-- delete -->
     <div class="modal fade" id="delete_file" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
     <div class="modal-dialog" role="document">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title" id="exampleModalLabel"> Dosya silme</h5>
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                 </button>
             </div>
             <form action="{{ route('delete_file') }}" method="post">

                 {{ csrf_field() }}
                 <div class="modal-body">
                     <p class="text-center">
                     <h6 style="color:red"> ?Dosyayı silmek istediğinizden emin misiniz
                    </h6>
                     </p>

                     <input type="text" name="id_file" id="id_file" value="">
                     <input type="text" name="file_name" id="file_name" value="">
                     <input type="text" name="fatura_numarasi" id="fatura_numarasi" value="">

                 </div>
                 <div class="modal-footer">
                     <button type="button" class="btn btn-default" data-dismiss="modal">İptal</button>
                     <button type="submit" class="btn btn-danger">Sil</button>
                 </div>
             </form>
         </div>
     </div>
 </div>
 </div>
    <!-- Container closed -->
    </div>
    <!-- main-content closed -->
@endsection
@section('js')
    <!--Internal  Datepicker js -->
    <script src="{{ URL::asset('assets/plugins/jquery-ui/ui/widgets/datepicker.js') }}"></script>
    <!-- Internal Select2 js-->
    <script src="{{ URL::asset('assets/plugins/select2/js/select2.min.js') }}"></script>
    <!-- Internal Jquery.mCustomScrollbar js-->
    <script src="{{ URL::asset('assets/plugins/custom-scroll/jquery.mCustomScrollbar.concat.min.js') }}"></script>
    <!-- Internal Input tags js-->
    <script src="{{ URL::asset('assets/plugins/inputtags/inputtags.js') }}"></script>
    <!--- Tabs JS-->
    <script src="{{ URL::asset('assets/plugins/tabs/jquery.multipurpose_tabcontent.js') }}"></script>
    <script src="{{ URL::asset('assets/js/tabs.js') }}"></script>
    <!--Internal  Clipboard js-->
    <script src="{{ URL::asset('assets/plugins/clipboard/clipboard.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/clipboard/clipboard.js') }}"></script>
    <!-- Internal Prism js-->
    <script src="{{ URL::asset('assets/plugins/prism/prism.js') }}"></script>

    <script>
        $('#delete_file').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var id_file = button.data('id_file')
            var file_name = button.data('file_name')
            var fatura_numarasi = button.data('fatura_numarasi')
            var modal = $(this)
            modal.find('.modal-body #id_file').val(id_file);
            modal.find('.modal-body #file_name').val(file_name);
            modal.find('.modal-body #fatura_numarasi').val(fatura_numarasi);
        })
    </script>
@endsection

