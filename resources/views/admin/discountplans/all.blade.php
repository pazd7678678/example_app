@component('admin.layouts.content' , ['title' => 'لیست تخفیف'])
    @slot('breadcrumb')
        <li class="breadcrumb-item"><a href="/admin">پنل مدیریت</a></li>
        <li class="breadcrumb-item active">لیست تخفیف‌ها</li>
    @endslot

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">تخفیف‌ها</h3>

                    <div class="card-tools d-flex">
                        <form action="">
                            <div class="input-group input-group-sm" style="width: 150px;">
                                <input type="text" name="search" class="form-control float-right" placeholder="جستجو" value="{{ request('search') }}">

                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                                </div>
                            </div>
                        </form>
                        <div class="btn-group-sm mr-1">
{{--                            @can('create-product')--}}
                                <a href="{{ route('admin.discountplans.create') }}" class="btn btn-info">ایجاد تخفیف جدید</a>
{{--                            @endcan--}}
                        </div>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover">
                        <tbody>
                        <tr>
                            <th>آی‌دی طرح تخفیفی</th>
                            <th> نام طرح تخفیفی</th>
                            <th>میزان تخفیف (درصد)</th>
                            <th>مربوط به کاربر</th>
                            <th>مربوط به محصول</th>
                            <th> تاریخ آغاز طرح</th>
                            <th> تاریخ پایان طرح</th>
                            <th>اقدامات</th>
                        </tr>

                        @foreach($discount_plans as $discount)
                            <tr>
                                <td>{{ $discount->id }}</td>
                                <td>{{ $discount->name }}</td>
                                <td>{{ $discount->percent }}</td>
                                
                                <td>{{ $discount->users->count() ? $discount->users->pluck('name')->join(', ') : 'همه کاربران' }}</td>
                                <td>{{ $discount->products->count() ? $discount->products->pluck('title')->join(', ') : 'همه محصولات' }}</td>
                                <td>{{ $discount->start_at }}</td>
                                <td>{{ $discount->expired_at }}</td>
                                <td class="d-flex">
{{--                                    // permissions--}}
                                    <form action="{{ route('admin.discountplans.destroy' , $discount->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger ml-1">حذف</button>
                                    </form>
                                    <a href="{{ route('admin.discountplans.edit' , $discount->id) }}" class="btn btn-sm btn-primary ml-1">ویرایش</a>
                                </td>
                            </tr>
                        @endforeach


                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    {{ $discount_plans->appends([ 'search' => request('search') ])->render() }}
                </div>
            </div>
            <!-- /.card -->
        </div>
    </div>

@endcomponent
