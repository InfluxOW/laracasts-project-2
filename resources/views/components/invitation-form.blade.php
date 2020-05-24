<div class="card flex flex-col mt-3">
    <h3 class="text-xl font-normal py-4 -ml-5 border-l-4 border-accent pl-4 mb-3">
        Invite a user
    </h3>

    {!! Form::open(['url' => route('projects.invitations.store', $project)]) !!}
        {!! Form::text('email', '', ['class' => 'border border-muted-light bg-card rounded w-full py-2 px-3 mb-3', 'placeholder' => 'Email address']) !!}
        {!! Form::button('Invite', ['class' => 'button mt-2 w-full', 'type' => 'submit']) !!}
        <x-error name='email' bag="project_invitation"/>

    {!! Form::close() !!}
</div>
