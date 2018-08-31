<template>
    <div class="container col-md-8 col-md-offset-2">
        <div class="panel panel-primary">
            <div class="panel-heading">
                Phonebook Application
                <AddUi></AddUi>
                <UpdateUi></UpdateUi>
            </div>
            <div class="panel-body">
                <ul class="list-group phone-list">
                    <li class="list-group-item" v-for="item,key in list">
                        <span>{{ item.name }}</span>
                        <span>{{ item.phone }}</span>
                        <span>{{ item.email }}</span>
                        <span class="actions" @click="openUpdate(key)"><i class="glyphicon glyphicon-pencil"></i></span>
                        <span class="actions" @click="del(key, item.id)"><i class="glyphicon glyphicon-remove"></i></span>
                    </li>
                </ul>
            </div>
            <div class="panel-footer">
                
            </div>
        </div>
    </div>
</template>

<script>
let AddUi = require('./AddUi.vue');
let UpdateUi = require('./Update.vue');
export default{
    components:{
        AddUi,
        UpdateUi
    },
    data(){
        return {
            list:{
            },
            errors:{
            }
        }
    },
    mounted(){
        var self = this;
        axios.post('/getData')
        .then(function (response) {
            console.log(response.data);
            self.list = response.data;
            $('#myModal').modal('hide');
        })
        .catch(function (error) {
            self.errors = error.response.data;
        });
    },
    methods:{
        openUpdate(key){
            var self = this;
            self.$children[1].list = self.list[key];
            $('#updateModal').modal('show');
        },
        del(key, id){
            if ( confirm("Are you sure you want to delete?") ) {
                var self = this;
                axios.delete(`/phonebook/${id}`)
                .then(function (response) {
                    console.log(response.data);
                    self.list.splice(key, 1);
                })
                .catch(function (error) {
                    self.errors = error.response.data;
                });
            }
        }
    }
}
</script>