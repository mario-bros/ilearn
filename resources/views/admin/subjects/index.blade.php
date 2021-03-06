@extends('admin.app')

@section('page_description')
    <a href="{{ route('lms-admin.subjects.create') }}" class="btn btn-flat btn-info btn-xs"><i class="fa fa-plus"></i> Tambah Baru</a>
@endsection

@section('content')
<div class="row">
	<div class="pull-right col-xs-6 col-sm-4 col-md-3">

		{!! Form::open(['method' => 'get']) !!}
			<div class="form-group {!! $errors->has('title') ? 'has-error' : '' !!}">
				<div class="input-group">
					<span class="input-group-addon"><i class="fa fa-search"></i></span>
					{!! Form::text( 'q', Request::has('q') ? Request::get('q') : null, ['class' => 'form-control', 'placeholder' => 'Cari mata pelajaran...']) !!}
				</div>
			</div>
		{!! Form::close() !!}
		
	</div>
</div>
<div class="row">
	<div class="col-xs-12">
		<div class="box">
			<div class="box-header">
				<h3 class="box-title">Tabel Kelas</h3>
			</div>
			<div class="box-body">
				<table id="subjects-datatable" class="table table-bordered table-hover">
					<thead>
						<tr>
							<th>Kelas</th>
							<th>Mata Pelajaran</th>
						</tr>
					</thead>
					<tbody>
						@foreach ($subjects as $classroom)
							<tr>
                <td>
                	<div>{{ $classroom->name }}</div>
                	<div>
                		<a href="{{ route('lms-admin.subjects.edit', $classroom->id) }}" class="btn btn-flat btn-link btn-xs">Edit</a>
  									{!! Form::open(['route' => ['lms-admin.subjects.destroy', $classroom->id], 'method' => 'delete', 'class' => 'form-delete-inline']) !!}
    									{!! Form::submit('Hapus', ['class'=>'btn btn-flat btn-link btn-link-danger btn-xs warning-delete', 'data-title' => $classroom->name]) !!}
    								{!! Form::close() !!}
                	</div>
                </td>
                <td>{!! $classroom->description !!}</td>
              </tr>
            @endforeach
          </tbody>
          <tfoot>
						<tr>
							<th>Nama</th>
							<th>Deskripsi</th>
						</tr>
					</tfoot>
				</table>
				<div class="pull-right">
				@if( Request::has('q') )
					{!! $subjects->appends(['q' => Request::get('q')])->links() !!}
				@else
					{!! $subjects->links() !!}
				@endif
				</div>
			</div>
		</div>
	</div>
</div><!-- /.row -->
@endsection