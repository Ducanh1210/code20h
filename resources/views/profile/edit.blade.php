<x-app-layout>
    <x-slot name="header">
        <h2 class="h4 mb-0 fw-bold text-dark">
            {{ __('Hồ sơ cá nhân') }}
        </h2>
    </x-slot>

    <div class="container-fluid p-0">
        <div class="row g-4 justify-content-center">
            <div class="col-lg-8">
                <!-- Update Profile Info -->
                <div class="card border-0 shadow-sm rounded-4 mb-4">
                    <div class="card-body p-4 p-md-5">
                        <div class="max-w-xl">
                            @include('profile.partials.update-profile-information-form')
                        </div>
                    </div>
                </div>

                <!-- Update Password -->
                <div class="card border-0 shadow-sm rounded-4 mb-4">
                    <div class="card-body p-4 p-md-5">
                        <div class="max-w-xl">
                            @include('profile.partials.update-password-form')
                        </div>
                    </div>
                </div>

                <!-- Delete Account -->
                <div class="card border-0 shadow-sm rounded-4 border-start border-danger border-5">
                    <div class="card-body p-4 p-md-5">
                        <div class="max-w-xl text-danger">
                            @include('profile.partials.delete-user-form')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
