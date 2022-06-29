<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <a class="nav-link" href="{{ route('register') }}">{{ __('Add Author') }}</a>
                    <div class="card-body">
                        I'm an author manager.
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
