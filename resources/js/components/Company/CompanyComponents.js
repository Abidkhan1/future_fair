import Vue from 'vue';

//Event Components


//Profile Components
Vue.component('comp-profile',require('./Profile/CompanyProfileComponent.vue').default);
Vue.component('comp-banner-poster',require('./Profile/ProfileBannerPosterComponent.vue').default);
Vue.component('comp-upload-documents',require('./Profile/ProfileDocumentsComponent.vue').default);
Vue.component('comp-upload-videos',require('./Profile/ProfileVideosComponent.vue').default);
Vue.component('comp-design',require('./Profile/ProfileDesignComponent.vue').default);
Vue.component('comp-gallery',require('./Profile/ProfileGalleryComponent.vue').default);

//Staff Components
Vue.component('add-staff',require('./Staff/AddStaffComponent.vue').default);
Vue.component('edit-staff',require('./Staff/EditStaffComponent.vue').default);

//Offer Components
Vue.component('add-offer',require('./Offer/AddOfferComponent.vue').default);
Vue.component('edit-offer',require('./Offer/EditOfferComponent.vue').default);
