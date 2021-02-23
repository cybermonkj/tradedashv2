<style>
	.custom-flex {
		display: flex;
		justify-content: space-between;
		align-items: center;
	}
	#actions {
		/* border: 2px solid red; */
		display: flex;
		align-items: center;
	}

	@media (min-width: 768px) {
		#actions {
			
		}
	}
</style>

<div class="panel-header " style="background-color: {{$settings->header_color}}">
	<div class="py-5 page-inner" style="background-color: {{$settings->header_color}}">
		<div class="custom-flex">
			<div>
				<h2 class="pb-2 text-white fw-bold">
					{{ $breadcome }}
				</h2>				
			</div>
			<div class="py-2 ml-md-auto py-md-0" id="actions">
				<a href="/{{$user->username}}/investments" class="mr-2 btn btn-white btn-border btn-round">Investments</a>
				<a href="/{{$user->username}}/wallet" class="btn btn-secondary btn-round">Deposit</a>
			</div>
		</div>
	</div>
</div>