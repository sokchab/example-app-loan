 @extends('layouts.app')
 @section('title','Auth Update')
 @section('auth', 'active') 
 @section('content')
 <div class="content-wrapper">
     <section class="content-header">
         <div class="container-fluid">
             <div class="row mb-2">
                 <div class="col-sm-6">
                     <span>Edit User</span>
                 </div>
                 <div class="col-sm-6">
                     <ol class="breadcrumb float-sm-right">
                         <ol class="breadcrumb float-sm-right __kh__">
                             <li class="breadcrumb-item"><span class="text-primary">Authentication</span></li>
                         </ol>
                     </ol>
                 </div>
             </div>
         </div>
     </section>
 
     <section class="content">
         <div class="row">
             <div class="col-12">
                 <div class="card">
                     <div class="card-header">
                         <h3 class="card-title">
                             <a href="{{ route('auth.index') }}"><i class="fas fa-reply mr-1"></i>Back</a>
                         </h3>
                     </div>
                     <form action="{{ route('auth.update', $user->id) }}" method="POST"> @csrf @method('put')
                     <div class="card-body">
                         <div class="row">
                             <div class="col-sm-4">
                                 <div class="form-group">
                                     <label for="name">Name</label>
                                     <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" 
                                        name="name" value="{{ old('name', $user->name) }}" readonly autocomplete="name">
 
                                     @error('name')
                                         <span class="invalid-feedback" role="alert">
                                             <strong>{{ $message }}</strong>
                                         </span>
                                     @enderror
                                   </div>
                             </div>
 
 
                             <div class="col-sm-4">
                                 <div class="form-group">
                                     <label for="gender">Gender</label>
                                     <select id="gender" type="text" class="form-control @error('gender') is-invalid @enderror" name="gender">
                                         <option value="1" {{ old('gender', $user->gender) ? 'selected' : '' }}>Male</option>
                                         <option value="0" {{ !old('gender', $user->gender) ? 'selected' : '' }}>Female</option>
                                     </select>
                                     @error('gender')
                                         <span class="invalid-feedback" role="alert">
                                             <strong>{{ $message }}</strong>
                                         </span>
                                     @enderror
                                   </div>
                             </div>
 
                             <div class="col-sm-4">
                                 <div class="form-group">
                                     <label for="email">Email address</label>
                                     <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" 
                                        name="email" value="{{ old('email', $user->email) }}" readonly>
 
                                     @error('email')
                                         <span class="invalid-feedback" role="alert">
                                             <strong>{{ $message }}</strong>
                                         </span>
                                     @enderror
                                   </div>
                             </div>
 
                             <div class="col-sm-4">
                                 <div class="form-group">
                                     <label for="is_admin">Type</label>
                                     <select id="is_admin" type="text" class="form-control @error('is_admin') is-invalid @enderror" name="is_admin">
                                         <option value="1" {{ old('is_admin', $user->is_admin) ? 'selected' : '' }}>Administrator</option>
                                         <option value="0" {{ !old('is_admin', $user->is_admin) ? 'selected' : '' }}>User</option>
                                     </select>
                                     @error('is_admin')
                                         <span class="invalid-feedback" role="alert">
                                             <strong>{{ $message }}</strong>
                                         </span>
                                     @enderror
                                   </div>
                             </div>


                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="is_active">Status</label>
                                    <select id="is_active" type="text" class="form-control @error('is_active') is-invalid @enderror" name="is_active">
                                        <option value="1" {{ old('is_active', $user->is_active) ? 'selected' : '' }}>Active</option>
                                        <option value="0" {{ !old('is_active', $user->is_active) ? 'selected' : '' }}>Disable</option>
                                    </select>
                                    @error('is_active')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                  </div>
                            </div>
 
                             {{-- <div class="col-sm-4">
                                 <div class="form-group">
                                     <label for="password">Password</label>
                                     <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
 
                                     @error('password')
                                         <span class="invalid-feedback" role="alert">
                                             <strong>{{ $message }}</strong>
                                         </span>
                                     @enderror
                                   </div>
                             </div>
 
                             <div class="col-sm-4">
                                 <div class="form-group">
                                     <label for="email">Confirm Password</label>
                                     <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                     
                                   </div>
                             </div>
                            --}}
                         </div>
                        
                     </div>
                     <div class="card-footer">
                         <div class="float-right">
                             <button type="submit" class="btn bg-gradient-olive"><i class="fas fa-save mr-1"></i> Submit</button>
                         </div>
                     </div>
                     </form>
                 </div>
             </div>
         </div>
     </section>
 </div>
 @endsection
 