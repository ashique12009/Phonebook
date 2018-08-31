<template>
    <span class="modal-container">
        <button class="btn btn-success" data-toggle="modal" data-target="#myModal">Add New</button>
        <!-- Modal -->
        <div id="myModal" class="modal fade" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Add Information</h4>
                </div>
                <div class="modal-body">
                    <div class="alert alert-danger" v-if="errors.name">
                        {{ errors.name[0] }}
                    </div>
                    <div class="alert alert-danger" v-if="errors.phone">
                        {{ errors.phone[0] }}
                    </div>
                    <div class="alert alert-danger" v-if="errors.email">
                        {{ errors.email[0] }}
                    </div>
                    <div class="form-group">
                        <label class="control-label">Name</label>
                        <input class="form-control" value="" type="text" v-model="list.name">
                    </div>
                    <div class="form-group">
                        <label class="control-label">Phone</label>
                        <input class="form-control" value="" type="text" v-model="list.phone">
                    </div>
                    <div class="form-group">
                        <label class="control-label">Email</label>
                        <input class="form-control" value="" type="email" v-model="list.email">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" @click="save">Submit</button>
                </div>
                </div>

            </div>
        </div>
    </span>
</template>

<script>
    export default{
        data(){
            return{
                list:{
                    name: '',
                    phone: '',
                    email: ''
                },
                modalornot: '',
                errors:{
                }
            }
        },
        methods:{
            save(){
                var self = this;
                axios.post('/phonebook', self.$data.list)
                .then(function (response) {
                    console.log(response);
                    $('#myModal').modal('hide');
                })
                .catch(function (error) {
                    self.errors = error.response.data;
                });
            }
        }
    }
</script>