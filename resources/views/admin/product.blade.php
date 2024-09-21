<div>
	<form action="" method="POST">
		@csrf
		<div>
			<label for="">Nama Product: </label>
			<input type="text" name="name">
		</div>
		<div>
			<button type="submit">Submit</button>
		</div>
	</form>
</div>

<ul>
	@foreach ($dataProduct as $item)
		<li>
			{{ $item->name }} - {{ $item->tags->pluck('name')->implode(', ') }}s
			<ul>
				@foreach($item->tags as $item2)
					<li>{{ $item2->name }}</li>
				@endforeach
			</ul>
		</li>
	@endforeach
</ul>