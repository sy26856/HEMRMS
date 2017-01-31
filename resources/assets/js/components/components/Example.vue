<template>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Example Component</div>

                    <div class="my-body">
                        I'm an example !
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

    export default {
        mounted() {
            console.log('Component ready.')
        }
    }
</script>
<style style rel="stylesheet/sass" lang="sass">
    $primaryColor: red;
    $lineheight: 20px;
    .my-body{
    color: $primaryColor;
    border:1px solid red;
    font-size: $lineheight;
    }
</style>
