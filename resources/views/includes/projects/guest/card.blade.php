<div class="card mt-4">
    <div class="card-header d-flex align-items-center justify-content-between">
        {{ $project->title}}
        <a href="{{route('guest.projects.show', $project->slug)}}" class="btn btn-sm btn-primary ">Vedi</a>
    </div>
    <div class="card-body">
        <div class="row">
            @if ($project->image)
                <div class="col-3 text-center">
                    <img class="img-fluid" src="{{ $project->printImage() }}" alt="{{ $project->title }}">
                </div>       
            @endif
            <div class="col">
                <h5 class="card-title">{{ $project->title}}</h5>
                <h6 class="card-subtitle my-3 text-body-secondary">{{ $project->created_at}}</h6>
                <div class="mb-3 fs-5">
                    @if($project->type) 
                        <span class="badge rounded-pill" style="background-color: {{ $project->type->color }}"> {{ $project->type->label }} </span> 
                    @else
                        Nessuna 
                    @endif
                </div>
                <div class="mb-2">
                    @forelse ($project->technologies as $technology)
                    <span class="badge rounded-pill text-bg-{{ $technology->color }}">{{ $technology->label }}</span>
                    @empty
                        Nessuna
                    @endforelse
                </div>  
                <p class="card-text">{{ $project->content }}</p>
            </div>
        </div>
    </div>
</div>