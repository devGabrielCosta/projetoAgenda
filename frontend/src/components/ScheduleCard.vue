<template>
  <div class="calendar">
    <div class="selectors">
      <select id="ubs" v-model="selectedUbs" @change="onUbsChanged" v-if="loggedType != 'Patient'">
        <option v-if="loggedType != 'Receptionist'" :value="null"></option>       
        <option v-for="(ubs, index) in ubsList" :value="ubs.id" :key="index">
          {{ubs.name}}
        </option>
      </select>         
      <select id="doctor" v-model="selectedDoctor" @change="onDoctorChanged" v-if="loggedType == 'Receptionist'">
        <option v-for="(doctor, index) in doctorList" :value="doctor.id" :key="index">
          {{doctor.name}}
        </option>
      </select>
      <button @click="searchSchedules">Recarregar</button>
    </div>
    <div class="schedules">
      <div 
          v-for="(schedule, index) in scheduleList" :key="index" 
          :class="[
            'line', 
            schedule.id == selectedSchedule?.id ? 'selected' : '',
            schedule.status == 'Created' && loggedType == 'Doctor' ? 'selectable' : ''
          ]" 
          @click="schedule.status == 'Created' ? onClickSchedule($event, schedule) : ''"
      >
        <div>{{schedule.scheduled_time}}</div>
        <div>AINDA NÃO RETORNA</div>
        <div>{{schedule.status}}</div>
      </div>
    </div>
  </div>
</template>

<script>
  import { watch, inject, watchEffect } from 'vue';

  export default {
    data() {     
      const viewState = inject('viewState');

      return {
        ubsList: [],
        doctorList: [],
        scheduleList: [],
        selectedUbs: null,
        selectedDoctor: null,
        loggedType: this.$store.getters.getLoggedType,
        loggedId: this.$store.getters.getLoggedId,
        selectedSchedule: null,
        viewState
      }
    },
    mounted(){   
      switch(this.loggedType){
        case 'Patient': 
          this.searchSchedules(); 
          break;
        case 'Doctor':
          this.searchUbs(); 
          this.searchSchedules(); 
          break;
        case 'Receptionist': 
          this.searchUbs().then(()=>{
            this.selectedUbs = this.ubsList[0].id;
            this.searchDoctors();
            this.searchSchedules(); 
          });
          break;
      }

      watch(() => this.selectedSchedule, (newValue) => {
        if (newValue === null) {
          this.searchSchedules();
        }
      });

      watchEffect(() => {
        this.selectedSchedule = this.viewState.selectedSchedule
      });
      
    },
    methods:{
      onUbsChanged(){
        this.doctorList = [];
        this.scheduleList = [];
        this.selectedDoctor = null;
        this.changeStateSchedule(null);
        this.searchSchedules();

        if(this.loggedType == 'Receptionist')
          this.searchDoctors();
      },
      onDoctorChanged(){
        this.scheduleList = [];
        this.changeStateSchedule(null);
        this.searchSchedules();
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
      searchSchedules(){  
        var routes = {
          "Patient": 'user/'+this.loggedId+'/schedules',
          "Doctor": 'user/'+this.loggedId+'/schedules',
          "Doctor2": 'user/'+this.loggedId+'/schedules'+'?ubs_id='+this.selectedUbs,
          "Receptionist": 'ubs/'+this.selectedUbs+'/schedules',
          "Receptionist2": 'user/'+this.selectedDoctor+'/schedules'+'?ubs_id='+this.selectedUbs,
        };

        var changeQuery = {
          "Doctor": this.selectedUbs != null,
          "Receptionist": this.selectedDoctor != null
        }
        var type = this.loggedType;
        var selector = type;
        selector += changeQuery[type] ? '2' : '';
        var selectedRoute = routes[selector];

        this.axios
          .get(selectedRoute)
          .then(response => {
            if(response.data)
              this.scheduleList = response.data;
          })
      },
      onClickSchedule(event, schedule){
        this.changeStateSchedule(schedule);          
      },
      changeStateSchedule(schedule){
        this.viewState.selectedSchedule = schedule
      }
    }
  }
  
</script>

<style scoped>

  .calendar{
    background-color: white;
    min-width: 500px;
    height: 35vh;
    display: flex;
    align-items: center;
    flex-direction: column;
    gap: 2vw;

    .selectors{
      width: 100%;
      display: flex;
      justify-content: space-between;
      align-items: center;

      select{
        min-width: 15%;
      }
    }

    .schedules{
      width: 90%;
      display: flex;
      gap: 1vh;
      flex-direction: column;
      justify-content: start;
      align-items: center;
      overflow: auto;
    }

    .line{
      display: flex;
      justify-content: space-around;
      width: 100%;
      padding: 1%;
      border: 2px solid black;       
    }

    .selectable:hover{
      background-color: rgb(185, 198, 192);
    }

    .selected{
      background-color: rgb(119, 198, 119);
    }
  }

</style>
