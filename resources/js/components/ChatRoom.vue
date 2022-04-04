<template>
  <ul class="list-group">
    <li class="list-group-item list-group-item-action flex-column align-items-start" v-for="room in rooms" :key="room.id" @click="chooseId(room.id)">
      <div class="row">
        <div class="col-4">
          <img class="img-fluid mr-4" v-if="room.samp_id!=null" :src="'/storage/imgsampling/'+room.sampling.detp.img" alt="image">
          <img class="img-fluid mr-4" v-else :src="'/storage/imgsampling/'+room.produksi.detp.img" alt="image">
        </div>
        <div class="col-8">
          <div class="d-flex w-100 justify-content-between">
              <h5 class="mb-1" v-if="room.samp_id!=null">List group item heading {{room.sampling.detp.img}}</h5>
              <h5 class="mb-1" v-else>List group item heading {{room.produksi.detp.img}}</h5>
              <small>3 days ago</small>
          </div>
          <p class="mb-1">Donec id elit non mi porta gravida at eget metus. Maecenas sed diam eget risus varius blandit.</p>
          <small>Donec id elit non mi porta.</small>
        </div>
      </div>
    </li>
    <li class="list-group-item list-group-item-action flex-column align-items-start" >
        <div class="d-flex justify-content-center" data-toggle="modal" data-target="#exampleModalLong">
            <h2 class="mb-1"><i class="ti-plus"></i></h2>
            
        </div>
    </li>
    <div class="modal fade" id="exampleModalLong">
      <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Buka Room Baru</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                </div>
                <div class="modal-body">
                     <label class="col-form-label">Jenis</label>
                    <select class="custom-select mb-2" v-model="selectedJ" name="model">
                        <option  value="0">Konsultasi Produksi/Sampling</option>
                        <option  value="1">Komplain Paska-Produksi/Sampling</option>
                        <option  value="2">Konsultasi Pra-Pemesanan</option>
                    </select>
                    <label class="col-form-label" v-if="selectedJ!=2">Tipe Jasa</label>
                    <select class="custom-select mb-2" v-if="selectedJ!=2" v-model="selectedT" name="model">
                        <option  value="0">Produksi</option>
                        <option  value="1">Sampling</option>
                        
                    </select>
                    <label class="col-form-label" v-if="selectedT!=null && selectedJ!=2">Subyek</label>
                    <select class="custom-select mb-2" v-if="selectedT==0 && selectedJ!=2" v-model="selectedP" name="model">
                        <option v-for="produksi in jasas.produksi" :key="produksi.id">{{produksi.id}}</option>
                    </select>

                    <select class="custom-select mb-2" v-if="selectedT==1 && selectedJ!=2" v-model="selectedS" name="model">
                        <option v-for="sampling in jasas.sampling" :key="sampling.id">{{sampling.id}}</option>
                    </select>
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" v-if="selectedJ==2" @click="submitroom(2)">Save changes2</button>
                    <button type="submit" class="btn btn-primary" v-else-if="selectedJ==0" @click="submitroom(0)">Save changes0</button>
                    <button type="submit" class="btn btn-primary" v-else-if="selectedJ==1" @click="submitroom(1)">Save changes1</button>
                    
                  
                </div>
            </div>
        </div>
    </div>
  </ul>

</template>
<script>
export default {
  //Takes the "user" props from <chat-form> … :user="{{ Auth::user() }}"></chat-form> in the parent chat.blade.php.
  props: ["rooms","jasas"],
  data() {
    return {
      room: "",
      selectedJ: '',
      selectedT: '',
      selectedS: '',
      selectedP: '',
    };
  },
  methods: {
    chooseId(value) {
      this.$emit("chooseroom", {
        room: value,
      });
      
      
    },
    submitroom(value) {
      switch (value) {
        case 0:
          if(this.selectedT==0){
            this.$emit("newroom", {
              jenis:this.selectedJ,
              tipejasa:this.selectedT,
              jasa_id: this.selectedP,
            });
          }else if(this.selectedT==1){
            this.$emit("newroom", {
              jenis:this.selectedJ,
              tipejasa:this.selectedT,
              jasa_id: this.selectedS,
            });
          }
          break;
        case 1:
          if(this.selectedT==0){
            this.$emit("newroom", {
              jenis:this.selectedJ,
              tipejasa:this.selectedT,
              jasa_id: this.selectedP,
            });
          }else if(this.selectedT==1){
            this.$emit("newroom", {
              jenis:this.selectedJ,
              tipejasa:this.selectedT,
              jasa_id: this.selectedS,
            });
          }
          break;
        case 2:
          this.$emit("newroom", {
              jenis:this.selectedJ,
              tipejasa:null,
              jasa_id: null,
          });
          break;
      }
      
      
    },
  },
};
</script>