<template>
  <div class="calendar">
    <div class="selectors">
      <select id="ubs" v-model="selectedUbs" @change="onUbsChanged" v-if="!isPatient">
        <option v-if="!isReceptionist" :value="null"></option>       
        <option v-for="(ubs, index) in ubsList" :value="ubs.id" :key="index">
          {{ubs.name}}
        </option>
      </select>         
      <select id="doctor" v-model="selectedDoctor" @change="onDoctorChanged" v-if="isReceptionist">
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
            changeLineColor(schedule)
          ]" 
          @click="isClickable(schedule) ? onClickSchedule($event, schedule) : null"
      >
        <div>{{schedule.scheduled_time}}</div>
        <div v-if="!isDoctor">{{schedule.doctor?.name}}</div>
        <div v-if="!isPatient">{{schedule.patient?.name}}</div>
        <div v-if="!selectedUbs">{{schedule.ubs?.name}}</div>
        <div>{{schedule.status}}</div>
      </div>
    </div>
  </div>
</template>

<script>
  import { watch, inject } from 'vue';

  export default {
    data() {     
      const viewState = inject('viewState');

      return {
        ubsList: [],
        doctorList: [],
        scheduleList: [],
        selectedUbs: null,
        selectedDoctor: null,
        viewState,
      }
    },
    computed: {
      loggedType() { 
        return this.$store.getters.getLoggedType;
      },
      loggedId() { 
        return this.$store.getters.getLoggedId;
      },
      isDoctor() { 
        return this.loggedType === 'Doctor';
      },
      isPatient() { 
        return this.loggedType === 'Patient';
      },
      isReceptionist() { 
        return this.loggedType === 'Receptionist';
      },
      selectedSchedule() { 
        return this.viewState.selectedSchedule;
      },
      reloadScheduleCard(){
        return this.viewState.reloadScheduleCard
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

      watch(() => this.reloadScheduleCard, (newValue) => {
        if (newValue == true) {
          this.searchSchedules();
          this.reloadScheduleCard = false;
        }
      });
    },
    methods:{   
      isClickable(schedule){
        return schedule.status != 'NoShow' && this.loggedType != 'Receptionist';
      },
      changeLineColor(schedule){
        if(this.loggedType == 'Receptionist')
        return '';

        return this.isClickable(schedule) ? 'selectable' : 'disabled' ;
      },
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
        var routes = {
          "Doctor": 'user/'+this.loggedId+'/ubs',
          "Receptionist": 'ubs/',
        };

        var selectedRoute = routes[this.loggedType];

        await this.axios
          .get(selectedRoute)
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
      background-color: rgba(0, 255, 34, 0.292);
    }

    .disabled{
      background-color: rgba(255, 0, 0, 0.151);
    }

    .selected{
      background-color: rgba(0, 255, 34, 0.438);
    }
  }

</style>