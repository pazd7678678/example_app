

@component('admin.layouts.content',['title'=> 'لیست کاربران'])



@slot('breadcrumb')
<li class="breadcrumb-item"><a href="/admin">پنل مدیریت</a></li>
<li class="breadcrumb-item active">لیست کاربران</li>





@endslot









<div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">کاربران</h3>

                <div class="card-tools d-flex">
                  <div class="input-group input-group-sm" style="width: 150px;">
                    <input type="text" name="table_search" class="form-control float-right" placeholder="جستجو">

                    <div class="input-group-append">
                      <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                    </div>
                  </div>
                  <div class="btn-group-sm mr-1">
                    <a href="{{route('admin.users.create')}}" class="btn btn-info">ایجاد کاربر جدید</a>
                  </div>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover">
                  <tbody><tr>
                    <th>آی دی کاربر</th>
                    <th>نام کاربر</th>
                    <th>ایمیل</th>
                    <th>وضعیت ایمیل</th>
                    <th>اقدامات</th>
                  
                  </tr>
              @foreach($users as $user)
              <tr>
                    <td>{{$user->id}}</td>
                    <td>{{$user->name}}</td>
                    <td>{{$user->email}}</td>
                    <td><span class="badge badge-success">تایید شده</span></td>
                   <td>
                    <a href="" class="btn btn-danger btn-sm">حذف</a>
                    <a href="admin.users.update" class="btn btn-primary btn-sm">ویرایش</a>
                   </td>
                  </tr>





              @endforeach
             
                </tbody></table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        








@endcomponent