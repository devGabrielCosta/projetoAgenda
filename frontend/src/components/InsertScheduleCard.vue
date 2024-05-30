<template>
  <div class="insertScheduleCard">
    <h1>Criar Agendamento <button id="show-modal" @click="showModal = true">Inserir Paciente</button></h1>
    <form @submit.prevent="submitForm">
      <label for="user_id">Paciente:</label>
        <select id="role" v-model="selectedRole">
          <option value="">Selecione...</option>
          <option value="admin">Administrador</option>
        </select><br/><br/>    
      <label for="user_id">UBS:</label>
        <select id="role" v-model="selectedRole">
          <option value="">Selecione...</option>
          <option value="admin">Administrador</option>
        </select><br/><br/>    
      <label for="user_id">Doutor:</label>
        <select id="role" v-model="selectedRole">
          <option value="">Selecione...</option>
          <option value="admin">Administrador</option>
        </select><br/><br/>
      <label for="user_id">Horário:</label>        
      <input type="datetime-local" id="user_id" v-model="userId"> 
      <br/><br/> 
      <button type="submit">Enviar</button>
    </form>
      <ModalTemplate v-if="showModal" @close="showModal = false">
          <InsertPatientCard />
      </ModalTemplate>
  </div>
</template>

<script>

  import InsertPatientCard from './InsertPatientCard.vue'
  import ModalTemplate from './ModalTemplate.vue'

  export default {   
    data() {
      return {
        showModal: false
      };
    },
    components: {
      InsertPatientCard,
      ModalTemplate
    }
  }

</script>

<style scoped>

  .insertScheduleCard{
    background-color: white;

      h1{
        width: 100%;
        display: flex;
        justify-content: space-between;
      }

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
