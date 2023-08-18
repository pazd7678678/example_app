@component('admin.layouts.content' , ['title' => 'فرم ایجاد طرح تخفیفی'])
    @slot('breadcrumb')
        <li class="breadcrumb-item"><a href="/admin">پنل مدیریت</a></li>
        <li class="breadcrumb-item"><a href="{{ route('admin.discountplans.index') }}">لیست طرح ها</a></li>
        <li class="breadcrumb-item active">ایجاد طرح تخفیفی</li>
    @endslot

    @slot('script')
        <script>

            $('#users').select2({
                'placeholder' : 'کاربر مورد نظر را انتخاب کنید'
            })

            $('#products').select2({
                'placeholder' : 'محصول مورد نظر را انتخاب کنید'
            })

         
        </script>
    @endslot

    <div class="row">
        <div class="col-lg-12">
            @include('admin.layouts.errors')
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">فرم ایجاد طرح تخفیفی</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form class="form-horizontal" action="{{ route('admin.discountplans.store') }}" method="POST">
                    @csrf

                    <div class="card-body">
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">نام طرح</label>
                            <input type="text" name="name" class="form-control" id="inputEmail3" placeholder="نام طرح را وارد نمایید" value="{{ old('name') }}">
                        </div>
                        <div class="form-group">
                            <label for="precent" class="col-sm-2 control-label">میزان تخفیف (درصد)</label>
                            <input type="number" name="percent" class="form-control" placeholder="درصد تخفیف را وارد کنید" value="{{ old('percent') }}">
                        </div>
                        <div class="form-group">
                            <label for="precent" class="col-sm-2 control-label"> نوع پرداخت</label>
                            <select class="form-control" name="payment_type" id="" >
                               
                                    <option value="cash">نقدی</option>
                                    <option value="ghesti">قسطی</option>

                            </select>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">کاربر مربوط به تخفیف (اختیاری)</label>
                            <select class="form-control" name="users[]" id="users" multiple>
                                <option value="null">همه کاربرها</option>
                                @foreach(\App\Models\User::all() as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="inputPassword3" class="col-sm-2 control-label">محصول مربوطه (اختیاری)</label>
                            <select class="form-control" name="products[]" id="products" multiple>
                                <option value="null">همه محصول</option>
                                @foreach(\App\Models\Product::all() as $product)
                                    <option value="{{ $product->id }}">{{ $product->title }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">تاریخ شروع طرح</label>
                            <input type="datetime-local" name="start_at" class="form-control" id="inputEmail3" placeholder=" تاریخ شروع را وارد نمایید" value="{{ old('expired_at') }}">
                        </div>
                    

                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label"> تاریخ پایان طرح</label>
                            <input type="datetime-local" name="expired_at" class="form-control" id="inputEmail3" placeholder="ملهت استفاده را وارد کنید" value="{{ old('expired_at') }}">
                        </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <button type="submit" class="btn btn-info">ثبت کد تخفیف</button>
                        <a href="{{ route('admin.discountplans.index') }}" class="btn btn-default float-left">لغو</a>
                    </div>
                    <!-- /.card-footer -->
                </form>
            </div>
        </div>
    </div>



@endcomponent
