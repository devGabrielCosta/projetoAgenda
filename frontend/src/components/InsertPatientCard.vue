<template>
  <div class="insertScheduleCard">  
    <h1>Inserir Paciente</h1>
    <form @submit.prevent="sendForm">
      <label for="name">Nome</label>
      <input type="text" id="name" v-model="name">
      <button type="submit">Enviar</button>
    </form>
  </div>
</template>

<script>

  export default {
    props: ['parentCallback'],
    data(){
      return {
        name: null
      }
    },
    methods:{     
      sendForm()
      { 
        this.axios
          .post('user', {
            name: this.name,
            type: "Patient"
          })
          .then(response => {
            if(response.data)
            {
              this.$notify({
                text: "Paciente inserido",
                type: "success"
              });
              this.parentCallback();
            }
          })
          .catch(error =>{
              this.$notify({
                text: error.response.data,
                type: "error"
              });
          })
      },
    }
  }

</script>

<style scoped>

  .insertScheduleCard{
    background-color: white;

      form {
      margin-top: 20px;
      }
      label {
        display: block;
        margin-bottom: 5px;
      }
      input[type="text"] {
        width: 200px;
        padding: 5px;
        margin-bottom: 10px;
      }
  }

</style>
