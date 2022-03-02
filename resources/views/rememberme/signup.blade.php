<div class="container">
    <div class="row justify-content-center">
       <div class="col-lg-6">
          <div class="main">
             <h3><a>Remember me in Laravel Example</a></h3>
             <form role="form" action="{{route('post.register')}}" method="post">
                @csrf
                <div class="form-group">
                   <label for="userename">Name <span class="text-danger">*</span></label>
                   <input type="text" name="name" class="form-control">
                    @if ($errors->has('name'))
                   <span class="text-danger">{{ $errors->first('name') }}</span>
                   @endif
                </div>
                <div class="form-group">
                   <label for="useremail">Email <span class="text-danger">*</span></label>
                   <input type="email" name="email"  class="form-control">
                    @if ($errors->has('email'))
                   <span class="text-danger">{{ $errors->first('email') }}</span>
                   @endif
                </div>
                <div class="form-group">
                   <label for="userpassword">Password <span class="text-danger">*</span></label>
                   <input type="password" name="password" class="form-control">
                    @if ($errors->has('password'))
                   <span class="text-danger">{{ $errors->first('password') }}</span>
                   @endif
                </div>
                <div class="form-group">
                </div>
                <button type="submit" class="btn btn btn-secondary">
                Register
                </button>
             </form>
          </div>
       </div>
    </div>
</div>
