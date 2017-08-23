<template>
    <div class="col-md-6" style="margin-left:-185px;">
        <div class="panel panel-default">
            <div class="panel-heading">Dashboard</div>

            <div class="panel-body">
                <form method="post" action="meeting">
                    <input class="form-control" name="title" placeholder="title of the meeting"><br>
                    <input class="form-control" type="hidden" name="user_id"><br>
                    <input class="form-control" name="date" type="date"><br>
                    <button type="submit" class="btn btn-info btn-lg">Schedule Meeting</button>
                </form>
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