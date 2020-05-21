<div class="card flex flex-col mt-3">
    <h3 class="text-xl font-normal py-4 -ml-5 border-l-4 border-blue-custom pl-4 mb-3">
        Invite a user
    </h3>

    {!! Form::open(['url' => route('projects.invitations.store', $project)]) !!}
        <div class="mb-3">
            {!! Form::text('email', '', ['class' => 'border border-gray-custom rounded w-full py-2 px-3', 'placeholder' => 'Email address']) !!}
        </div>
        {!! Form::button('Invite', ['class' => 'button is-link mr-2', 'type' => 'submit']) !!}
    {!! Form::close() !!}
</div>
