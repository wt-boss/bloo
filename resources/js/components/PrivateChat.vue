<template>
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-9">
                <!-- DIRECT CHAT PRIMARY -->
                <div class="box box-primary box-solid direct-chat direct-chat-primary" id="taille">
                    <div class="box-header with-border">
                        <h3 class="box-title">Direct Chat</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <!-- Conversations are loaded here -->
                        <div class="direct-chat-messages" v-chat-scroll>
                            <!-- Message. Default to the left -->
                            <div :class="(user.id===message.user.id)? 'direct-chat-msg': 'direct-chat-msg right' "
                                 v-for="(message,index) in allMessages"
                                 :key="index"
                            >
                                <div class="direct-chat-infos clearfix">
                                    <span :class="(user.id===message.user.id)? 'direct-chat-name pull-left' : 'direct-chat-name pull-right' ">{{message.user.first_name}} {{message.user.last_name}}</span>
                                    <span :class="(user.id===message.user.id)? 'direct-chat-timestamp pull-right' : 'direct-chat-timestamp pull-left' ">{{message.created_at}}</span>
                                </div>
                                <img class="direct-chat-img" :src="message.user.avatar" alt="Message User Image">
                                <div class="direct-chat-text">
                                    {{message.message}}
                                </div>
                            </div>
                        </div>
                        <!--/.direct-chat-messages-->
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                        <div class="input-group">
                            <input
                                type="text" name="message" placeholder="Ecriver votre Message..."
                                class="form-control" v-model="message"
                                @keyup.enter="sendMessage"
                            >
                            <span class="input-group-btn">
                          <button type="submit" class="btn btn-primary btn-flat"
                                  @click="sendMessage"
                          >Envoyer</button>
                        </span>
                        </div>
                    </div>
                    <!-- /.box-footer-->
                </div>
                <!--/.direct-chat -->
            </div>
            <!-- /.col -->
            <div class="col-md-3">
                <div class="row">
                    <div class="col-md-12">
                        <div class="box box-warning box-solid">
                            <div class="box-header with-border">
                                <h3 class="box-title">Operateur</h3>
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body">
                                <ul class="list-group">

                                    <li :class="'list-group-item' "
                                        v-for="friend in users"
                                        v-if="user.id !== friend.id && friend.role===1"
                                        v-show="operation_id=operation"
                                        :key="friend.id"
                                        @click="activeFriend=friend.id"
                                    > <a>{{friend.first_name}} {{friend.last_name}} </a> </li>

                                </ul>
                            </div>
                            <!-- /.box-body -->
                        </div>
                        <!-- /.box -->
                    </div>


                    <div class="col-md-12">
                        <div class="box box-warning box-solid">
                            <div class="box-header with-border">
                                <h3 class="box-title">Lecteurs</h3>
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body">
                                <ul class="list-group">

                                    <li :class="'list-group-item' "
                                        v-show="operation_id=operation"
                                        v-for="friend in users"
                                        v-if="user.id !== friend.id && friend.role===0"
                                        :key="friend.id"
                                        @click="activeFriend=friend.id"
                                    > <a>{{friend.first_name}} {{friend.last_name}}</a> </li>
                                </ul>
                            </div>
                            <!-- /.box-body -->
                        </div>
                        <!-- /.box -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props:['user','operation'],
        data(){
            return{
                message:null,
                activeFriend:null,
                allMessages:[],
                users:[],
                operation_id:null,
            }
        },

        watch:{
            activeFriend(val){
                this.fetchMessages();
            }
        },

        methods:{
            sendMessage(){
                if(!this.message)
                {
                    return alert('Please enter message');
                }
                if(!this.activeFriend)
                {
                    return alert('Please select friend');
                }
                axios.post('/private-message/'+this.activeFriend+'/'+this.operation_id, {message: this.message}).then(response =>{
                    console.log(response.data);
                    this.message=null;
                    this.fetchMessages();
                }).catch(error => {
                    console.log(error);
                });
            },
            fetchMessages() {
                if(!this.activeFriend)
                {
                    return alert('Please select friend');
                }
                axios.get('/private-message/'+this.activeFriend +"/"+this.operation_id).then(response => {
                    this.allMessages = response.data;
                }).catch(error => {
                    console.log(error);
                });

            },
            fetchUsers() {
                axios.get('/users_list').then(response => {
                    this.users = response.data;
                });
            },
        },
        mounted(){
            Echo.private('privatechat.'+this.user.id)
                .listen('PrivateMessageSent',(e)=>{
                    this.activeFriend=e.message.user_id;
                    this.allMessages.push(e.message)
                });
        },
        created(){
            this.fetchUsers();
        }
    }
</script>
