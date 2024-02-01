@extends('back.layout.pages-layout')
@section('pageTitle', isset($pageTitle)? $pageTitle : 'Settings')
@section('content')
    
<div class="page-body">
    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-lg-6">
                    <div class="page-header-left">
                        <h3>إعدادت الموقع
                        </h3>
                    </div>
                </div>
                <div class="col-lg-6">
                    <ol class="breadcrumb pull-right">
                        <li class="breadcrumb-item">
                            <a href="index.html">
                                <i data-feather="home"></i>
                            </a>
                        </li>
                        <li class="breadcrumb-item">لوحة التحكم</li>
                        <li class="breadcrumb-item active">إعدادات الموقع</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- Container-fluid Ends-->

    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <div class="row product-adding">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-header">
                        <h5>الاعدادات</h5>
                    </div>
                    <div class="card-body">
                        <div class="digital-add needs-validation">
                            <form action="" method="post" enctype="multipart/form-data">
                                @csrf
                                @method('put')

                                @if($errors->any())
                                {!! implode('', $errors->all('<div>:message</div>')) !!}
                            @endif

                            <div class="form-group">
                                <label for="validationCustom05" class="col-form-label pt-0">
                                    لوجو الموقع</label>
                                <input class="form-control" id="validationCustom05" type="file" name="logo">
                            </div>
                            <div class="form-group">
                                <label class="col-form-label">الصورة المصغرة</label>
                                <input class="form-control" id="validationCustom05" type="file" name="favicon">
                            </div>



                            <div class="form-group">
                                <label for="validationCustom01" class="col-form-label pt-0"><span>*</span>
                                    اسم الموقع</label>
                                <input class="form-control" id="validationCustom01" type="text" name="name" value="">
                            </div>


                            <div class="form-group">
                                <label class="col-form-label">وصف الموقع</label>
                                <textarea rows="5" cols="12" name="description"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="validationCustom02" class="col-form-label"><span>*</span>
                                    البريد الإلكتروني </label>
                                <input class="form-control" id="validationCustom02" type="text" name="email" value="">
                            </div>

                            <div class="form-group">
                                <label for="validationCustomtitle" class="col-form-label pt-0">رقم الهاتف</label>
                                <input class="form-control" id="validationCustomtitle" type="text" name="phone" value="">
                            </div>

                            <div class="form-group">
                                <label for="validationCustomtitle" class="col-form-label pt-0">العنوان</label>
                                <input class="form-control" id="validationCustomtitle" type="text" name="address" value="">
                            </div>

                            <div class="form-group">
                                <label for="validationCustomtitle" class="col-form-label pt-0">رابط الفيس بوك</label>
                                <input class="form-control" id="validationCustomtitle" type="text" name="facebook" value="">
                            </div>

                            <div class="form-group">
                                <label for="validationCustomtitle" class="col-form-label pt-0">رابط تويتر</label>
                                <input class="form-control" id="validationCustomtitle" type="text" name="twitter" value="">
                            </div>

                            <div class="form-group">
                                <label for="validationCustomtitle" class="col-form-label pt-0">حساب الانستجرام</label>
                                <input class="form-control" id="validationCustomtitle" type="text" name="instagram" value="">
                            </div>

                            <div class="form-group">
                                <label for="validationCustomtitle" class="col-form-label pt-0"> اليوتيوب</label>
                                <input class="form-control" id="validationCustomtitle" type="text" name="youtube" value="">
                            </div>


                            <div class="form-group">
                                <label for="validationCustomtitle" class="col-form-label pt-0">التيك توك</label>
                                <input class="form-control" id="validationCustomtitle" type="text" name="tiktok" value="">
                            </div>

                            <div class="form-group">
                                <button class="btn btn-primary" type="submit">حفظ</button>
                            </div>


                            </form>

                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <!-- Container-fluid Ends-->
</div>
    
@endsection