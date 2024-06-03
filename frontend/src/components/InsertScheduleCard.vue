<template>
  <div class="insertScheduleCard">
    <h1>Criar Agendamento <button id="show-modal" @click="showModal = true">Inserir Paciente</button></h1>
    <form @submit.prevent="sendForm">
      <label for="patient">Paciente:</label>
      <select id="patient" v-model="selectedPacient" required>
        <option :value="null"></option>       
        <option v-for="(patient, index) in patientList" :value="patient.id" :key="index">
          {{patient.name}}
        </option>
      </select>   
      <label for="ubs">UBS:</label>
      <select id="ubs" v-model="selectedUbs" @change="onUbsChanged" required>
        <option v-for="(ubs, index) in ubsList" :value="ubs.id" :key="index">
          {{ubs.name}}
        </option>
      </select>    
      <label for="doctor">Doutor:</label>
      <select id="doctor" v-model="selectedDoctor" required>
        <option :value="null"></option>       
        <option v-for="(doctor, index) in doctorList" :value="doctor.id" :key="index">
          {{doctor.name}}
        </option>
      </select>   
      <label for="user_id">Horário:</label>        
      <input type="datetime-local" id="user_id" v-model="scheduledTime" required> 
      <br/><br/> 
      <button type="submit">Enviar</button>
    </form>
      <ModalTemplate v-if="showModal" @close="showModal = false">
          <InsertPatientCard :parentCallback="closeModal"/>
      </ModalTemplate>
  </div>
</template>

<script>

  import InsertPatientCard from './InsertPatientCard.vue'
  import ModalTemplate from './ModalTemplate.vue'
  import { inject } from 'vue';

  export default {   
    data() {
      const viewState = inject('viewState');

      return {
        showModal: false,
        patientList: {},
        ubsList: {},
        doctorList: {},
        selectedPacient: null,
        selectedUbs: null,
        selectedDoctor: null,
        scheduledTime: null,
        loggedId: this.$store.getters.getLoggedId,
        viewState
      };
    },
    components: {
      InsertPatientCard,
      ModalTemplate
    },
    mounted(){
      this.searchPatients();
      this.searchUbs().then(()=>{
        this.selectedUbs = this.ubsList[0].id;
        this.searchDoctors();
      });     
    },
    methods:{
      closeModal(){
        this.showModal = false;
        this.searchPatients();
      },
      onUbsChanged(){
        this.doctorList = [];
        this.selectedDoctor = null;
        this.searchDoctors();
      },
      async searchUbs(){
        await this.axios
          .get('ubs/')
          .then(response => {
            if(response.data)
              this.ubsList = response.data;
          });
      },  
      searchDoctors(){
        this.axios
          .get('ubs/'+this.selectedUbs+'/doctors')
          .then(response => {
            if(response.data)
            {
              this.doctorList = response.data;
            }
          })
      }, 
      searchPatients(){
        this.axios
          .get('user?type=Patient')
          .then(response => {
            if(response.data)
            {
              this.patientList = response.data;
            }
          })
      },
      sendForm()
      { 
        var body = {
            receptionist_id: this.loggedId,
            patient_id: this.selectedPacient,
            doctor_id: this.selectedDoctor,
            ubs_id: this.selectedUbs,
            scheduled_time: this.scheduledTime,
        };

        this.axios
          .post('schedule', body)
          .then(response => {
            if(response.data){
              this.reloadScheduleCard();
              this.$notify({
                text: "Agendamento inserido",
                type: "success"
              });
              this.resetForm();
            }
          })
          .catch(error =>{
              this.$notify({
                text: error.response.data,
                type: "error"
              });
          })
      },
      reloadScheduleCard(){
        this.viewState.reloadScheduleCard = true;
      },
      resetForm()
      {
        this.selectedDoctor = null,
        this.selectedPacient = null,
        this.selectedUbs = this.ubsList[0].id,
        this.scheduledTime = null
      }
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

      input,
      select{
        min-width: 20%;
        margin-bottom: 7px;
      }
  }

</style>
