<template>
<div class="container">
 <div class="row justify-content-center">
        <div class="col-md-12">
           

              
                <div class="card">
                    <div class="card-header">
                     Crear Tweet
                    </div>
                    <div class="card-body">
              
                      <div class="form-group">
                     
                        <textarea v-model="content" class="form-control" id="exampleFormControlTextarea1"
                         rows="3"></textarea>
                      </div>
                    
                      <a href="#" class="btn btn-primary" @click="crearTweet()" style="float: right">Crear Tweet</a>
                    </div>
                  </div>
            </div>
        </div>
        <br>
        <div class="card border-info mb-12" v-for="tweet in tweets" >
            <div class="card-header bg-transparent border-info">{{tweet.name}}</div>
            <div class="card-body ">
        
              <p class="card-text">{{tweet.content}}</p>
            </div>
            <div class="card-footer bg-transparent border-info">
              <div v-if="usuario.id == tweet.id_user">
                <span class="badge badge-info">{{
                     since(tweet.created_at) }}</span>
                <span class="badge badge-success" style="float: right">Editar</span>
                <span class="badge badge-danger" style="float: right">Borrar</span>
              </div>

            </div>
             
          </div>
          <br>  <br>
          </div>
              
</div>  
         
</template>

<script>
import  axios from 'axios'
import toastr from 'toastr'
import moment from 'moment'
moment.lang('es')
let etiqueta= document.head.querySelector('meta[name="user"');
let user= JSON.parse(etiqueta.content);
    export default {
        data(){
            return {
                tweets:[],
                usuario:'',
                content:''
            }
            },
           computed: {
              user(){
 this.usuario= JSON.parse(etiqueta.content);
              }
           },
            methods: {
                since:function(d){
                        return moment(d).fromNow();
                },
                getTweets:function(){
                    var urlTweets='index';
                    axios.get(urlTweets).then(response=>{
                        this.tweets=response.data
                        console.log(this.tweets)
                    })
                },
                crearTweet(){
                    var url="store";
                    axios.post(url,{
                        content: this.content
                    }).then(response=>{
                        this.getTweets();
                        this.content='';
                        toastr.success('Nuevo tweet registrado');
                    }).
                    catch(error=>{
                        toastr.error('Error');

                    })
                }
            },
        
        mounted() {
            console.log('Component mounted.')
                this.getTweets();
                 this.usuario= JSON.parse(etiqueta.content);
                console.log(this.usuario)
        }
    }
</script>
