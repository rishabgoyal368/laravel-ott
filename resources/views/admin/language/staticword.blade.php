@extends('layouts.admin')
@section('title','Static translation')
@section('content')
<div class="box admin-form-main-block mrg-t-40">
		<div class="box-header with-border">
			<a title="Cancel and go back" href="{{ url()->previous() }}" class=" btn-floating">
				<i class="material-icons">reply</i></a>
			</a>
			<div class="box-title">Static Word Translations for Language: {{ $findlang->name }}</div>
		</div>

		<div class="box-body">
				
			<div class="callout callout-info">
				<i class="fa fa-info-circle"></i> Update Each Translation Carefully and look for comma (,) also if adding new words else it will cause major errors.
			</div>

			<form action="{{ route('static.trans.update',$findlang->local) }}" method="POST">
				@csrf
				<textarea name="transfile" class="form-control" name="" id="" cols="100" rows="20">{{ $file }}</textarea>
			

		</div>
		<div class="box-footer">

			 <button type="reset" class="btn btn-info"><i class="material-icons left">toys</i> Reset</button>
			{{-- <button type="submit" class="btn btn btn-success">
				<i class="fa fa-save"></i> Save Changes
			</button> --}}
			<button type="submit" class="btn btn-success"><i class="material-icons left">add_to_photos</i> Update</button>

		{{-- 	<a title="Cancel and go back" href="{{ url()->previous() }}" class="btn btn-info">
			 <i class="material-icons left">toys</i> Reset
			</a> --}}
		</div>
		</form>
	</div>
@endsection