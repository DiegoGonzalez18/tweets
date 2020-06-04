<template>
<div class="container">
<div class="modal fade" :class="{'mostrar':modal}"  tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" @click="cerrarModal()">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <div class="form-group">
                     
                        <textarea v-model="content2" class="form-control" id="exampleFormControlTextarea1"
                         rows="3"></textarea>
                      </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal" @click="cerrarModal()">Cancelar</button>
        <button type="button" class="btn btn-primary" @click="editar(tweet.id)">Editar</button>
      </div>
    </div>
  </div>
</div>
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
                    tweet.created_at }}</span>
                <span class="badge badge-success" style="float: right" @click="abrirModal(tweet)">Editar</span>
                <span class="badge badge-danger" style="float: right" @click="remove(tweet.id)">Borrar</span>
                  
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
                content:'',id:'',modal:0,
                tweet:'',
                content2:''
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
                },
                remove(idr){
                    this.id=idr
                    console.log(this.id)
                           var url="remove?id="+this.id;
                    axios.delete(url).then(response=>{
                        this.getTweets();
                        this.id='';
                       console.log(response)
                    }).
                    catch(error=>{
                        toastr.error('Error');

                    })
                },
                abrirModal(data=[]){
                        this.modal=1;
                        this.tweet=data;
                        this.content2=this.tweet.content;
                }, cerrarModal(){
                    this.modal=0;
                    this.tweet='';
                        this.content2='';
                },
           editar(idr){
  this.id=idr
                    console.log(this.id)
                           var url="update?id="+this.id+'&content='+this.content2;
                    axios.put(url).then(response=>{
                        this.getTweets();
                        this.id='';
                       console.log(response)
                       this.cerrarModal();
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
<style>

.modal-content{
    width:100% !important;
    position: absolute !important;
}
.mostrar{
    display: list-item !important;
    opacity:1!important;
    position:absolute!important;
    background-color: #3c29297a !important;
    padding-top:30px;
}
</style>
