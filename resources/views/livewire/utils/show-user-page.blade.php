

<div style=" display: flex;grid-gap: 13px;margin-bottom: 25px;flex-direction: column;">
    <img src="{{ asset( $user->photoBanner ) }}" style="height: 400px;width: 100%;background-repeat: round;"/>
    <div style="height: 160px;">
        <div style="height: 240px;position: absolute;top: 368px;right: 63%;display: flex;align-items: center;">
             <img src="{{ asset($user->photo) }}" style="height: 250px;border-radius: 50%;width: 250px;background-size: cover;margin-left: 40px;"/>
             <h2 class="font-extrabold text-4xl ml-5">{{ $user->name }}</h2>
        </div>
    </div>
</div>
