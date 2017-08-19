<style scoped>
    .action-link {
        cursor: pointer;
    }

    .m-b-none {
        margin-bottom: 0;
    }
</style>
<template>
    <div>
        <div class="panel panel-default col-12" style="min-width:740px;">
           

            <div class="panel-body">
                <!-- Current meetings -->
                <p class="m-b-none" v-if="meetings.length === 0">
                    you have no meeting yet
                </p>

                <table class="table table-borderless m-b-none" v-if="meetings.length > 0">
                    <thead>
                    <tr>
                        <th>Meeting Id#</th>
                        <th>Title</th>
                        <th>Organizer</th>
                        <th></th>
                        <th></th>
                    </tr>
                    </thead>

                    <tbody>
                    <tr v-for="meeting in meetings">
                        <!-- ID -->
                        <td style="vertical-align: middle;">
                            {{ meeting.id }}
                        </td>

                        <!-- Name -->
                        <td style="vertical-align: middle;">
                            {{ meeting.title }}
                        </td>

                        <!-- Secret -->
                        <td style="vertical-align: middle;">
                            <code>{{ meeting.organizer }}</code>
                        </td>

                        <!-- Edit Button -->
                        <td style="vertical-align: middle;">
                            <a class="action-link" @click="edit(meeting)" >
                                Edit
                            </a>
                        </td>
                        <td style="vertical-align: middle;">
                            <a class="action-link" @click="agenda(meeting)" >
                                Add agenda
                            </a>
                        </td>
                        <td style="vertical-align: middle;">
                            <a class="action-link" @click="agenda(meeting)" >
                                Download report
                            </a>
                        </td>
                        <!-- Delete Button -->
                        <td style="vertical-align: middle;">
                            <a class="action-link text-danger" @click="destroy(meeting)">
                                Delete
                            </a>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!--Additional Detail modal-->
    <div class="modal fade" id="additional-detail-modal" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button " class="close" data-dismiss="modal" aria-hidden="true">&times;</button>

                    <h4 class="modal-title">
                        Create meeting
                    </h4>
                </div>

                <div class="modal-body">
                    <!-- Form Errors -->
                    <div class="alert alert-danger" v-if="createForm.errors.length > 0">
                        <p><strong>Whoops!</strong> Something went wrong!</p>
                        <br>
                        <ul>
                            <li v-for="error in createForm.errors">
                                {{ error }}
                            </li>
                        </ul>
                    </div>

                    <!-- Create meeting Form -->
                    <form class="form-horizontal" role="form">
                        <!-- Name -->
                        <div class="form-group">
                            <label class="col-md-3 control-label">Name</label>

                            <div class="col-md-7">
                                <input id="create-meeting-name" type="text" class="form-control"
                                       @keyup.enter="store" v-model="createForm.name">

                                <span class="help-block">
                                        Something your users will recognize and trust.
                                    </span>
                            </div>
                        </div>

                        <!-- Redirect URL -->
                        <div class="form-group">
                            <label class="col-md-3 control-label">Redirect URL</label>

                            <div class="col-md-7">
                                <input type="text" class="form-control" name="redirect"
                                       @keyup.enter="store" v-model="createForm.redirect">

                                <span class="help-block">
                                        Your application's authorization callback URL.
                                    </span>
                            </div>
                        </div>
                    </form>
                </div>

                <!-- Modal Actions -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

                    <button type="button" class="btn btn-primary" @click="store">
                        Create
                    </button>
                </div>
            </div>
        </div>
    </div>
        <!--Modal edit meeting-->
        <div class="modal fade" id="modal-edit-meeting" tabindex="-1" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button " class="close" data-dismiss="modal" aria-hidden="true">&times;</button>

                        <h4 class="modal-title">
                            Edit Client
                        </h4>
                    </div>

                    <div class="modal-body">
                        <!-- Form Errors -->
                        <div class="alert alert-danger" v-if="editForm.errors.length > 0">
                            <p><strong>Whoops!</strong> Something went wrong!</p>
                            <br>
                            <ul>
                                <li v-for="error in editForm.errors">
                                    {{ error }}
                                </li>
                            </ul>
                        </div>

                        <!-- Edit Client Form -->
                        <form class="form-horizontal" role="form">
                            <!-- Name -->
                            <div class="form-group">
                                <label class="col-md-3 control-label">Name</label>

                                <div class="col-md-7">
                                    <input id="edit-client-name" type="text" class="form-control"
                                           @keyup.enter="update" v-model="editForm.name">

                                    <span class="help-block">
                                        Something your users will recognize and trust.
                                    </span>
                                </div>
                            </div>

                            <!-- Redirect URL -->
                            <div class="form-group">
                                <label class="col-md-3 control-label">Redirect URL</label>

                                <div class="col-md-7">
                                    <input type="text" class="form-control" name="redirect"
                                           @keyup.enter="update" v-model="editForm.redirect">

                                    <span class="help-block">
                                        Your application's authorization callback URL.
                                    </span>
                                </div>
                            </div>
                        </form>
                    </div>

                    <!-- Modal Actions -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

                        <button type="button" class="btn btn-primary" @click="update">
                            Save Changes
                        </button>
                    </div>
                </div>
            </div>
        </div>


        <!--Modal for adding agenda-->
        <div class="modal fade" id="modal-agenda-meeting" tabindex="-1" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">


                    <!-- Modal Actions -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

                        <button type="button" class="btn btn-primary" @click="update">
                            Save Changes
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    export default {
        data() {
            return {
                meetings: [],

                createForm: {
                    errors: [],
                    name: '',
                    redirect: ''
                },

                editForm: {
                    errors: [],
                    name: '',
                    redirect: ''
                }
            };
        },
        /**
         * Prepare the component (Vue 1.x).
         */
        ready() {
            this.prepareComponent();
        },

        /**
         * Prepare the component (Vue 2.x).
         */
        mounted() {
            this.prepareComponent();
        },
        methods: {
            /**
             * Prepare the component.
             */
            prepareComponent() {
                this.getMeetings();

                $('#additional-detail-modal').on('shown.bs.modal', () => {
                    $('#create-meeting-name').focus();
                });

                $('#modal-edit-meeting').on('shown.bs.modal', () => {
                    $('#edit-meeting-name').focus();
                });
            },
            store() {
                this.persistmeeting(
                    'post', '/oauth/meetings',
                    this.createForm, '#modal-create-meeting'
                );
            },
            getMeetings() {
                axios.get('meetings')
                    .then(response => {

                        this.meetings = response.data;
                    });
            },
            edit(meeting) {
                this.editForm.id = meeting.id;
                this.editForm.title = meeting.title;
                this.editForm.redirect = meeting.redirect;
                $('#modal-edit-meeting').modal('show');
            },
            /**
             * Update the meeting being edited.
             */
            update() {
                this.persistClient(
                    'put', '/meeting' + this.editForm.id,
                    this.editForm, '#modal-edit-meeting'
                );
            },
            agenda(meeting){
                this.editForm.id = meeting.id;
                $('#modal-agenda-meeting').modal('show');
            },
            showAdditionalDetailModal() {
                $('#additional-detail-modal').modal('show');
            },
        }
    }
</script>