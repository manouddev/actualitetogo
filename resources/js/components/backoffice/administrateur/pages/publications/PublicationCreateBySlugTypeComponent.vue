<template>
    <!-- =======================Author list START -->
    <section class="py-4">
        <div class="container">
            <div  v-if="dataReady == 0" >
                <br/><br/><br/><br/><br/><br/><br/>
                <div class="d-flex justify-content-center">
                    <img src="https://actualitetogo.com/assets/images/logo.png"  style="width: 150px;" alt="empty">
                </div>
                <div class="d-flex justify-content-center mt-3">
                    <div class="spinner-border text-success" style="color: #006633" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>
                </div>
                <br/><br/><br/><br/><br/><br/><br/>
            </div>
            <div v-else-if="dataReady== 1">

                <!-- Author list title START -->
                <div class="row g-4 pb-4">
                    <div class="col-12">

                        <h3 class="mb-2 mb-sm-0 h2 text-center">
                            <div class=" align-items-center">
                                <router-link  :to="{name: 'admin.publications.create'}"  >
                                    <div class="btn btn-primary-soft  btn-round mb-0 " style="font-size: 25px">
                                        <i  class="bi bi-arrow-left-short"></i>
                                    </div>
                                </router-link>
                                Ajouter une publication

                            </div>
                        </h3>
                    </div>
                </div>

                <div class="row g-4" v-if="publicationCreateBySlugTypeShowData.typePublication.id === 2 || publicationCreateBySlugTypeShowData.typePublication.id === 3 ">
                    <!-- Left sidebar START -->
                    <div class="col-lg-12 col-xxl-8">
                        <!-- Profile START -->
                        <div class="card border mb-4">
                            <div class="card-header border-bottom p-3">
                                <h5 class="card-header-title mb-0">PUBLICATION {{publicationCreateBySlugTypeShowData.typePublication.name}}</h5>
                            </div>
                            <div class="card-body" v-if="empty == 0">

                                <div v-if="publicationStoreInfoAlertAnnonceCreateMessage">
                                    <div class="alert alert-danger"  role="alert">
                                        {{ publicationStoreInfoAlertAnnonceCreateMessage }}
                                    </div>
                                </div>

                                <form>
                                    <div class="row">
                                        <div class="col-lg-12 mb-5">
                                            <div class="row">
                                                <div class="col-lg-12 mb-3" v-if="publicationStoreInfoAlertAnnonceCreateErrors.title">
                                                    <label class="form-label" >Titre de la publication</label>
                                                    <QuillEditor theme="snow" v-model:content="title" contentType="html" />
                                                    <div v-for="errorname in publicationStoreInfoAlertAnnonceCreateErrors.title" :key="errorname" class="invalid-feedback">
                                                        {{ errorname }}
                                                    </div>
                                                </div>
                                                <div class="col-lg-12 mb-3" v-else>
                                                    <label class="form-label" >Titre de la publication</label>
                                                    <QuillEditor theme="snow" v-model:content="title" contentType="html" />

                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-4 mt-3">
                                            <label class="form-label" >Statut de publication</label>
                                            <select class="form-select" @change="handleSelectionSearchByStatus($event)" v-model="status" name="status" id="status">
                                                <option value="1" >Publier à l'instant</option>
                                                <option value="0" >Enregistrer comme brouillon</option>
                                                <option value="2" >Programmer la publication</option>
                                                <option value="3" >Mettre en attente de validation</option>
                                            </select>
                                        </div>
                                        <div class="col-lg-4 mt-3" v-if="show_date_publish">
                                            <div class="mb-3" >
                                                <label class="form-label">Choisir une de date de début</label>
                                                <div class="input-group">
                                                    <input type="datetime-local" class="form-control" v-model="date_publish" />
                                                </div>

                                            </div>
                                        </div>
                                        <div class="col-lg-4 mt-3" v-if="show_date_publish_end">
                                            <div class="mb-3" >
                                                <label class="form-label">Choisir une de date de fin</label>
                                                <div class="input-group">
                                                    <input type="datetime-local" class="form-control" v-model="date_publish_end" />
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-end mt-4" v-if="loadingPublicationStoreInfoAlertAnnonceCreate == false">
                                        <button type="button" @click="cancelFirst" class="btn btn-danger border-0 me-2">Annuler</button>
                                        <button type="submit"  @click="publicationStoreInfoAlertAnnonce" class="btn btn-primary">Enregistrer</button>
                                    </div>
                                    <div class="d-flex justify-content-end mt-4" v-else>
                                        <button type="button" disabled class="btn btn-success border-0 me-2">
                                            <i  style="color: #fff" class="fa fa-spinner fa-spin fa-1x fa-fw"></i>
                                            <span class="sr-only">Loading...</span>En cours de sauvegarde...</button>
                                    </div>
                                </form>
                            </div>

                            <div class="card-body p-3 pb-0" v-else-if="empty == 1">
                                <div class="row">
                                    <div class="col-md-3"></div>
                                    <div class="col-md-6">
                                      <div style="position: relative; height: 250px;">
                                          <img src="https://actualitetogo.com/assets/images/empty.png" style="width: 100px; position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);" alt="empty">
                                      </div>
                                      <h5 style="text-align: center; margin-top: -50px"> {{ publicationCreateBySlugTypeShowMessage  }} </h5>
                                    </div>
                                    <div class="col-md-3"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row g-4" v-else-if="publicationCreateBySlugTypeShowData.typePublication.id === 1">
                    <div class="col-lg-12 col-xxl-8">
                        <!-- Profile START -->
                        <div class="card border mb-4">
                            <div class="card-header border-bottom p-3">
                                <div class="d-sm-flex justify-content-sm-between align-items-center">
                                    <div class="d-flex align-items-center">
                                        <h5 class="card-header-title mb-0">PUBLICATION {{publicationCreateBySlugTypeShowData.typePublication.name}}</h5>

                                    </div>

                                </div>

                            </div>
                            <div class="card-body" v-if="empty == 0">

                                <div class="d-sm-flex justify-content-sm-between align-items-center mb-3" v-if="stepStoreArticleFirst == true">
                                    <div class="d-flex align-items-center">
                                        <h5 class="card-header-title mb-0">Les Informations de bases</h5>

                                    </div>
                                    <div class="d-flex mt-2 mt-sm-0">

                                        <div class="btn btn-primary btn-round mb-0 " @click="buttonStepStoreArticleFirstToTwo" style="font-size: 25px">
                                            <i  class="bi bi-arrow-right-short"></i>
                                        </div>
                                    </div>
                                </div>

                                <div v-if="stepStoreArticleFirst == true">

                                    <div v-if="publicationStoreArticleFirstStepCreateMessage">
                                        <div class="alert alert-danger"  role="alert">
                                            {{ publicationStoreArticleFirstStepCreateMessage }}
                                        </div>
                                    </div>

                                    <form>
                                        <div class="row">
                                            <div class="col-lg-12 mb-5">
                                                <div class="row">
                                                    <div class="col-lg-12 mb-3" v-if="publicationStoreArticleFirstStepCreateErrors.title">
                                                        <label class="form-label" >Titre de la publication</label>
                                                        <QuillEditor theme="snow" v-model:content="title" contentType="html" />
                                                        <div v-for="errorname in publicationStoreArticleFirstStepCreateErrors.title" :key="errorname" class="invalid-feedback">
                                                            {{ errorname }}
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-12 mb-3" v-else>
                                                        <label class="form-label" >Titre de la publication</label>
                                                        <QuillEditor theme="snow" v-model:content="title" contentType="html" />
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-lg-6 mt-3" v-if="publicationStoreArticleFirstStepCreateErrors.author">
                                                <label class="form-label" >Ajouter un auteur</label>
                                                <VueMultiselect
                                                    v-model="author "
                                                    :options="publicationCreateBySlugTypeShowData.authors"
                                                    :close-on-select="true"
                                                    :clear-on-select="false"
                                                    placeholder="Choisir un auteur"
                                                    label="authorName"
                                                    track-by="authorName"
                                                />
                                                <div v-for="errorauthor in publicationStoreArticleFirstStepCreateErrors.author" :key="errorauthor" class="invalid-feedback">
                                                    {{ errorauthor }}
                                                </div>
                                            </div>

                                            <div class="col-lg-6 mt-3" v-else>
                                                <label class="form-label" >Ajouter un auteur</label>
                                                <VueMultiselect
                                                    v-model="author "
                                                    :options="publicationCreateBySlugTypeShowData.authors"
                                                    :close-on-select="true"
                                                    :clear-on-select="false"
                                                    placeholder="Choisir un auteur"
                                                    label="authorName"
                                                    track-by="authorName"
                                                />
                                            </div>

                                            <div class="col-lg-6 mt-3" v-if="publicationStoreArticleFirstStepCreateErrors.category">
                                                <label class="form-label" >Ajouter des catégories</label>
                                                <VueMultiselect
                                                    v-model="category"
                                                    :options="publicationCreateBySlugTypeShowData.categories"
                                                    :multiple="true"
                                                    :taggable="true"
                                                    @tag="addCategory"
                                                    :close-on-select="true"
                                                    :clear-on-select="false"
                                                    placeholder="Choisir des catégories"
                                                    label="name"
                                                    track-by="name"
                                                />
                                                <div v-for="errorcategory in publicationStoreArticleFirstStepCreateErrors.category" :key="errorcategory" class="invalid-feedback">
                                                    {{ errorcategory }}
                                                </div>
                                            </div>

                                            <div class="col-lg-6 mt-3" v-else>
                                                <label class="form-label" >Ajouter des catégories</label>
                                                <VueMultiselect
                                                    v-model="category"
                                                    :options="publicationCreateBySlugTypeShowData.categories"
                                                    :multiple="true"
                                                    :taggable="true"
                                                    @tag="addCategory"
                                                    :close-on-select="true"
                                                    :clear-on-select="false"
                                                    placeholder="Choisir des catégories"
                                                    label="name"
                                                    track-by="name"
                                                />
                                            </div>

                                            <div class="col-lg-12 mt-3"  v-if="publicationStoreArticleFirstStepCreateErrors.source">
                                                <label class="form-label" >Ajouter le nom de la source</label>
                                                <input  name="source" v-model="source" type="text" class="form-control" placeholder="Veuillez entrer le nom de la source de cette publication">
                                            </div>

                                            <div class="col-lg-12 mt-3"  v-else>
                                                <label class="form-label" >Ajouter le nom de la source</label>
                                                <input  name="source" v-model="source" type="text" class="form-control" placeholder="Veuillez entrer le nom de la source de cette publication">
                                            </div>


                                        </div>
                                        <div class="d-flex justify-content-end mt-4" v-if="loadingPublicationStoreArticleFirstStepCreate == false">
                                            <button type="button" @click="cancelArticleFirst" class="btn btn-danger border-0 me-2">Annuler</button>
                                            <button type="submit"  @click="publicationStoreArticleFirstStep" class="btn btn-primary">Enregistrer</button>
                                        </div>
                                        <div class="d-flex justify-content-end mt-4" v-else>
                                            <button type="button" disabled class="btn btn-success border-0 me-2">
                                                <i  style="color: #fff" class="fa fa-spinner fa-spin fa-1x fa-fw"></i>
                                                <span class="sr-only">Loading...</span>En cours de sauvegarde...</button>
                                        </div>
                                    </form>
                                </div>
                                <div class="d-sm-flex justify-content-sm-between align-items-center mb-3" v-if="stepStoreArticleTwo == true">
                                    <div class="d-flex align-items-center">
                                        <h5 class="card-header-title mb-0">Redigez le contenu de la publication</h5>

                                    </div>
                                    <div class="d-flex mt-2 mt-sm-0">
                                        <div class="btn btn-danger btn-round mb-0 " @click="buttonStepStoreArticleTwoToFirst" style="font-size: 25px">
                                            <i  class="bi bi-arrow-left-short"></i>
                                        </div> &nbsp;
                                        <div class="btn btn-primary btn-round mb-0 " @click="buttonStepStoreArticleTwoToThree" style="font-size: 25px">
                                            <i  class="bi bi-arrow-right-short"></i>
                                        </div>
                                    </div>
                                </div>

                                <div v-if="stepStoreArticleTwo == true">

                                    <div class="col-lg-12 mt-3 mb-2" >
                                        <QuillEditor theme="snow"   toolbar="full" v-model:content="content" contentType="html" />
                                    </div>

                                    <form>


                                        <div class="col-lg-12 mt-3" v-if="publicationStoreArticleFirstStepCreateErrors.tag">
                                            <label class="form-label" >Ajouter des tags</label>
                                            <VueMultiselect
                                                v-model="tag"
                                                :options="publicationCreateBySlugTypeShowData.tags"
                                                :multiple="true"
                                                :taggable="true"
                                                @tag="addTag"
                                                :close-on-select="true"
                                                :clear-on-select="false"
                                                placeholder="Choisir des mots clés"
                                                label="name"
                                                track-by="name"
                                            />
                                            <div v-for="errortag in publicationStoreArticleFirstStepCreateErrors.tag" :key="errortag" class="invalid-feedback">
                                                {{ errortag }}
                                            </div>
                                        </div>

                                        <div class="col-lg-12 mt-3  " v-else>
                                            <label class="form-label" >Ajouter des tags</label>
                                            <VueMultiselect
                                                v-model="tag"
                                                :options="publicationCreateBySlugTypeShowData.tags"
                                                :multiple="true"
                                                :taggable="true"
                                                @tag="addTag"
                                                :close-on-select="true"
                                                :clear-on-select="false"
                                                placeholder="Choisir des mots clés"
                                                label="name"
                                                track-by="name"
                                            />
                                        </div>

                                        <div class="d-flex justify-content-end mt-4" v-if="loadingPublicationStoreArticleTwoStepCreate == false">
                                            <button type="button" @click="cancelArticleTwo" class="btn btn-danger border-0 me-2">Annuler</button>
                                            <button type="submit"  @click="publicationStoreArticleTwoStep" class="btn btn-primary">Enregistrer</button>
                                        </div>
                                        <div class="d-flex justify-content-end mt-4" v-else>
                                            <button type="button" disabled class="btn btn-success border-0 me-2">
                                                <i  style="color: #fff" class="fa fa-spinner fa-spin fa-1x fa-fw"></i>
                                                <span class="sr-only">Loading...</span>En cours de sauvegarde...</button>
                                        </div>
                                    </form>


                                </div>
                                <div class="d-sm-flex justify-content-sm-between align-items-center" v-if="stepStoreArticleThree == true">
                                    <div class="d-flex align-items-center">
                                        <h5 class="card-header-title mb-0">Joindre des fichiers</h5>
                                    </div>
                                    <div class="d-flex mt-2 mt-sm-0">
                                        <div class="btn btn-danger btn-round mb-0 " @click="buttonStepStoreArticleThreeToTwo " style="font-size: 25px">
                                            <i  class="bi bi-arrow-left-short"></i>
                                        </div>

                                    </div>
                                </div>

                                <div v-if="stepStoreArticleThree == true">
                                    <form>

                                    </form>
                                </div>
                            </div>

                            <div class="card-body p-3 pb-0" v-else-if="empty == 1">
                                <div class="row">
                                    <div class="col-md-3"></div>
                                    <div class="col-md-6">
                                      <div style="position: relative; height: 250px;">
                                          <img src="https://actualitetogo.com/assets/images/empty.png" style="width: 100px; position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);" alt="empty">
                                      </div>
                                      <h5 style="text-align: center; margin-top: -50px"> {{ publicationCreateBySlugTypeShowMessage  }} </h5>
                                    </div>
                                    <div class="col-md-3"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div v-else-if="dataReady== 2"> <accessUnAuthorizedAdmin></accessUnAuthorizedAdmin> </div>
            <div v-else-if="dataReady== 3 || dataReady == 4">
                <section class="overflow-hidden">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-9 text-center mx-auto my-0 my-md-5 py-0 py-lg-5 position-relative z-index-9">
                                <!-- SVG shape START -->
                                <figure class="position-absolute top-50 start-50 translate-middle opacity-7 z-index-n9">
                                <svg width="650" height="379" xmlns="http://www.w3.org/2000/svg" x="0px" y="0px"  viewBox="0 0 510 297">
                                    <g>
                                    <path class="fill-primary opacity-1" d="M121,147.4c0,6-4.8,10.8-10.8,10.8H47.6c-6,0-10.8-4.8-10.8-10.8v-11.5c0-6,4.8-10.8,10.8-10.8h62.6
                                    c6,0,10.8,4.8,10.8,10.8V147.4z"/>
                                    <path class="fill-primary opacity-1" d="M179.4,90.2c0,6-4.8,10.8-10.8,10.8h-62.6c-6,0-10.8-4.8-10.8-10.8V78.7c0-6,4.8-10.8,10.8-10.8h62.6
                                    c6,0,10.8,4.8,10.8,10.8V90.2z"/>
                                    <path class="fill-primary opacity-1" d="M459.1,26.3c0,6-4.8,10.8-10.8,10.8h-62.6c-6,0-10.8-4.8-10.8-10.8V14.8c0-6,4.8-10.8,10.8-10.8h62.6
                                    c6,0,10.8,4.8,10.8,10.8V26.3z"/>
                                    <path class="fill-primary opacity-1" d="M422.1,66.9c0,6-4.8,10.8-10.8,10.8h-62.6c-6,0-10.8-4.8-10.8-10.8V55.3c0-6,4.8-10.8,10.8-10.8h62.6
                                    c6,0,10.8,4.8,10.8,10.8V66.9z"/>
                                    <path class="fill-primary opacity-1" d="M275.8,282.6c0,5.9-4.8,10.8-10.8,10.8h-62.6c-6,0-10.8-4.8-10.8-10.8v-11.5c0-6,4.8-10.8,10.8-10.8h62.6
                                    c6,0,10.8,4.8,10.8,10.8V282.6z"/>
                                    <path class="fill-primary opacity-1" d="M87.7,42.9c0,5.9-4.8,10.8-10.8,10.8H14.3c-6,0-10.8-4.8-10.8-10.8V31.4c0-6,4.8-10.8,10.8-10.8h62.6
                                    c6,0,10.8,4.8,10.8,10.8V42.9z"/>
                                    <path class="fill-primary opacity-1" d="M505.9,123.4c0,6-4.8,10.8-10.8,10.8h-62.6c-6,0-10.8-4.8-10.8-10.8v-11.5c0-6,4.8-10.8,10.8-10.8h62.6
                                    c6,0,10.8,4.8,10.8,10.8V123.4z"/>
                                    <path class="fill-primary opacity-1" d="M482.5,204.9c0,5.9-4.8,10.8-10.8,10.8h-62.6c-6,0-10.8-4.8-10.8-10.8v-11.5c0-6,4.8-10.8,10.8-10.8h62.6
                                    c5.9,0,10.8,4.8,10.8,10.8V204.9z"/>
                                    <path class="fill-primary opacity-1" d="M408.3,258.8c0,5.9-4.8,10.8-10.8,10.8H335c-6,0-10.8-4.8-10.8-10.8v-11.5c0-6,4.8-10.8,10.8-10.8h62.6
                                    c6,0,10.8,4.8,10.8,10.8V258.8z"/>
                                    <path class="fill-primary opacity-1" d="M147,252.5c0,5.9-4.8,10.8-10.8,10.8H73.6c-6,0-10.8-4.8-10.8-10.8V241c0-5.9,4.8-10.8,10.8-10.8h62.6
                                    c6,0,10.8,4.8,10.8,10.8V252.5z"/>
                                    </g>
                                </svg>
                                </figure>
                                <!-- SVG shape START -->
                                <!-- Content -->
                                <h1 class="display-1 text-primary">Session expiré! </h1>
                                <h5>Votre delai de connexion est expiré, connectez vous pour acceder à cette page.</h5>
                                <span style="cursor: pointer"  @click="authModalClick('LIST')" class="btn btn-danger-soft mt-3"><i class="fas fa-long-arrow-alt-left me-3"></i>Se connecter</span>

                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </section>


    <div class="modal fade" id="authFormModalpublicationCreateBySlugTypeShow" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">


            <!-- Login Form -->
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" v-if="authSectionStepModal == 1">Se connecter</h5>
                    <h5 class="modal-title" v-else-if="authSectionStepModal == 2">Modifier le mot de passe</h5>
                    <h5 class="modal-title" v-else-if="authSectionStepModal == 3">S'inscrire</h5>
                    <button type="button" class="btn-close" @click="authFormModalpublicationCreateBySlugTypeShowClose" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div v-if="authSectionStepModal == 1" style="margin-bottom: -15px">
                        <div v-if="errorLogin">
                            <div class="alert alert-danger"  role="alert">
                                {{ errorLogin }}
                            </div>
                        </div>
                        <form>
                            <!-- Email -->
                            <div class="mb-3" v-if="errorsLogin.username">
                                <label class="form-label" for="exampleInputEmailLogin">Nom d'utilisateur ou email</label>
                                <input type="text" v-model="username" name="username" class="form-control is-invalid" id="exampleInputEmailLogin" placeholder="Votre nom d'utilisateur ou votre email">
                                <div v-for="errorUsername in errorsLogin.username" :key="errorUsername" class="invalid-feedback">
                                    {{ errorUsername }}
                                </div>
                            </div>
                            <div class="mb-3" v-else>
                                <label class="form-label" for="exampleInputEmailLoginInvalid">Nom d'utilisateur ou email</label>
                                <input type="text" v-model="username" name="username" class="form-control" id="exampleInputEmailLoginInvalid" placeholder="Votre nom d'utilisateur ou votre email">
                            </div>
                            <!-- Password -->
                            <div class="mb-3" v-if="errorsLogin.password">
                                <label class="form-label" for="exampleInputPassword1">Mot de passe</label>
                                <input v-model="password" name="password" class="form-control fakepassword is-invalid" type="password" id="psw-input" placeholder="*********">
                                <div class="input-group">
                                    <input v-model="password" name="password" class="form-control fakepassword" type="password" id="psw-input" placeholder="*********">
                                    <span class="input-group-text p-0" @click="showPassword" style="cursor: pointer">
                                        <i v-if="showPsw == false" class="fakepasswordicon far fa-eye cursor-pointer p-2 w-40px"></i>
                                        <i v-else class="fakepasswordicon far fa-eye-slash cursor-pointer p-2 w-40px"></i>
                                    </span>
                                </div>
                                <div class="rounded mt-1" id="psw-strength"></div>
                                <div id="exampleInputPassword1" v-for="errorPassword in errorsLogin.password" :key="errorPassword" class="invalid-feedback">
                                    {{ errorPassword }}
                                </div>
                            </div>
                            <div class="mb-3" v-else>
                                <label class="form-label"  for="exampleInputPassword1">Mot de passe</label>
                                <div class="input-group">
                                    <input v-model="password" name="password" class="form-control fakepassword" type="password" id="psw-input" placeholder="*********">
                                    <span class="input-group-text p-0" @click="showPassword" style="cursor: pointer">
                                        <i v-if="showPsw == false" class="fakepasswordicon far fa-eye cursor-pointer p-2 w-40px"></i>
                                        <i v-else class="fakepasswordicon far fa-eye-slash cursor-pointer p-2 w-40px"></i>
                                    </span>
                                </div>
                                <div class="rounded mt-1" id="psw-strength"></div>
                            </div>
                            <!-- Checkbox -->
                            <div class="mb-3 form-check">
                                <input type="checkbox" name="remember_me" v-model="remember_me" class="form-check-input" id="exampleCheck1">
                                <label class="form-check-label" for="exampleCheck1">Se souvenir de moi</label>
                            </div>

                            <button type="button" disabled v-if="loadingLogin" class="btn btn-success mx-auto w-100"> <i  style="color: #fff" class="fa fa-spinner fa-spin fa-1x fa-fw"></i>
                                <span class="sr-only">Loading...</span>  Connexion</button>
                            <button type="submit"  @click.prevent="submitLogin" v-else class="btn btn-success mx-auto w-100">Se connecter</button>

                        </form>

                    </div>
                    <div  v-if="authSectionStepModal == 2" style="margin-bottom: -15px">
                        <h6 v-if="step === 1">Email de vérification</h6>
                        <h6 v-else-if="step === 2">Code de rénitialisation</h6>
                        <h6 v-else-if="step === 3">Nouveau mot de passe</h6>

                        <div v-if="step === 1">
                            <div v-if="errorForgotPasswordFirst" class="mb-3">
                                <div class="alert alert-danger"  role="alert">
                                    {{ errorForgotPasswordFirst }}
                                </div>
                            </div>
                            <form >
                                <div class="mb-3" v-if="errorsForgotPasswordFirst.email">
                                    <input type="email" v-model="email" name="email" class="form-control is-invalid" id="exampleInputEmail1" placeholder="Veuillez entrer votre email">
                                    <div v-for="errorForgotPasswordemail in errorsForgotPasswordFirst.email" :key="errorForgotPasswordemail" class="invalid-feedback">
                                        {{ errorForgotPasswordemail }}
                                    </div>
                                </div>
                                <div class="mb-3" v-else>
                                    <input type="email" v-model="email" name="email" class="form-control" id="exampleInputEmail1" placeholder="Veuillez entrer votre email">
                                </div>
                                <!-- Button -->
                                <button type="button" disabled v-if="loadingForgotPasswordFirst" class="btn btn-success  mx-auto w-100"> <i  style="color: #fff" class="fa fa-spinner fa-spin fa-1x fa-fw"></i>
                                    <span class="sr-only">Loading...</span>Vérification</button>
                                <button type="submit" @click.prevent="submitVerifyForgotPasswordEmail" v-else class="btn btn-success  mx-auto w-100">Vérifier</button>
                            </form>
                        </div>
                        <div v-if="step === 2">
                            <div v-if="errorForgotPasswordTwo" class="mb-3">

                                <div class="alert alert-danger"  role="alert">
                                    {{ errorForgotPasswordTwo }}
                                </div>
                            </div>
                            <form>
                                <div class="mb-3" v-if="errorsForgotPasswordTwo.otp">

                                    <input type="text" v-model="otp" name="otp" class="form-control is-invalid" id="exampleInputOtp1" placeholder="Veuillez entrer votre code de vérification">
                                    <div v-for="errorForgotPasswordOtp in errorsForgotPasswordTwo.otp" :key="errorForgotPasswordOtp" class="invalid-feedback">
                                        {{ errorForgotPasswordOtp }}
                                    </div>
                                </div>
                                <div class="mb-3" v-else>

                                    <input type="text"  v-model="otp" name="otp" class="form-control" id="exampleInputOtp1" placeholder="Veuillez entrer votre code de vérification">
                                </div>
                                <div class="mb-3" v-if="loadingResendOTP">
                                    <span for="exampleInputOtp1"><span style="color: blue; cursor:pointer">Renvoie d'un nouveau code en cours ... </span></span>
                                </div>
                                <div class="mb-3" v-if="!loadingResendOTP">
                                    <span for="exampleInputOtp1" @click.prevent="submitResendOtp"><span style="color: blue; cursor:pointer">Renvoyer un nouveau code </span></span>
                                </div>
                                <div class="row" v-if="loadingForgotPasswordTwo">
                                    <div class="col-md-12">
                                        <button type="button" disabled class="btn btn-success  mx-auto w-100"> <i  style="color: #fff" class="fa fa-spinner fa-spin fa-1x fa-fw"></i>
                                            <span class="sr-only">Loading...</span>Validation
                                        </button>
                                    </div>
                                </div>
                                <div class="row" v-else>
                                    <div class="col-md-6">
                                        <span><span class="btn btn-primary  mx-auto w-100" @click="PreviousForgotPasswordStep"><i class="bi bi-arrow-left-short"></i>Retour</span></span>
                                    </div>
                                    <div class="col-md-6">
                                        <button type="submit" @click.prevent="submitVerifyForgotPasswordOtp" class="btn btn-success  mx-auto w-100">Valider</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div v-if="step === 3">
                            <div v-if="errorForgotPasswordThree" class="mb-3">
                                <div class="alert alert-danger"  role="alert">
                                    {{ errorForgotPasswordThree }}
                                </div>
                            </div>
                            <form>
                                <div class="mb-3" v-if="errorsForgotPasswordThree.password">
                                    <label class="form-label" for="exampleInputpassword1">Votre nouveau mot de passe</label>
                                    <div class="input-group">
                                        <input v-model="password" name="password" class="form-control fakepassword is-invalid" type="password" id="psw-input" placeholder="Veuillez entrer votre nouveau mot de passe">
                                        <span class="input-group-text p-0" @click="showPassword" style="cursor: pointer">
                                            <i v-if="showPsw == false" class="fakepasswordicon far fa-eye cursor-pointer p-2 w-40px"></i>
                                            <i v-else class="fakepasswordicon far fa-eye-slash cursor-pointer p-2 w-40px"></i>
                                        </span>
                                    </div>
                                    <div class="rounded mt-1" id="psw-strength"></div>
                                    <div id="exampleInputpassword1" v-for="errorpassword in errorsForgotPasswordThree.password" :key="errorpassword" class="invalid-feedback">
                                        {{ errorpassword }}
                                    </div>
                                </div>
                                <div class="mb-3" v-else>
                                    <label class="form-label" for="exampleInputpassword1">Votre nouveau mot de passe</label>
                                    <div class="input-group">
                                        <input v-model="password" name="password" class="form-control fakepassword" type="password" id="psw-input" placeholder="Veuillez entrer votre nouveau mot de passe">
                                        <span class="input-group-text p-0" @click="showPassword" style="cursor: pointer">
                                            <i v-if="showPsw == false" class="fakepasswordicon far fa-eye cursor-pointer p-2 w-40px"></i>
                                            <i v-else class="fakepasswordicon far fa-eye-slash cursor-pointer p-2 w-40px"></i>
                                        </span>
                                    </div>
                                    <div class="rounded mt-1" id="psw-strength"></div>
                                </div>

                                <div class="mb-3" v-if="errorsForgotPasswordThree.password_confirm">
                                    <label class="form-label" for="exampleInputpassword1">Confirmer le mot de passe</label>
                                    <div class="input-group">
                                        <input type="password" v-model="password_confirm" class="form-control fakepassword is-invalid"  name="password_confirm"  id="psw-input_c" placeholder="Veuillez confirmer le mot de passe">
                                        <span class="input-group-text p-0" @click="showPasswordC" style="cursor: pointer">
                                            <i v-if="showPsw == false" class="fakepasswordicon far fa-eye cursor-pointer p-2 w-40px"></i>
                                            <i v-else class="fakepasswordicon far fa-eye-slash cursor-pointer p-2 w-40px"></i>
                                        </span>
                                    </div>
                                    <div class="rounded mt-1" id="psw-strength"></div>
                                    <div id="exampleInputpassword1" v-for="errorpassword_confirm in errorsForgotPasswordThree.password_confirm" :key="errorpassword_confirm" class="invalid-feedback">
                                        {{ errorpassword_confirm }}
                                    </div>
                                </div>
                                <div class="mb-3" v-else>
                                    <label class="form-label" for="exampleInputpassword1">Confirmer le mot de passe</label>
                                    <div class="input-group">
                                        <input type="password" v-model="password_confirm" class="form-control fakepassword"  name="password_confirm"  id="psw-input_c" placeholder="Veuillez confirmer le mot de passe">
                                        <span class="input-group-text p-0" @click="showPasswordC" style="cursor: pointer">
                                            <i v-if="showPsw == false" class="fakepasswordicon far fa-eye cursor-pointer p-2 w-40px"></i>
                                            <i v-else class="fakepasswordicon far fa-eye-slash cursor-pointer p-2 w-40px"></i>
                                        </span>
                                    </div>
                                    <div class="rounded mt-1" id="psw-strength"></div>
                                </div>
                                <div class="row" v-else>
                                    <div class="col-md-6">
                                        <span><span class="btn btn-primary  mx-auto w-100" @click="PreviousHForgotPasswordStep"><i class="bi bi-arrow-left-short"></i>Retour</span></span>
                                    </div>
                                    <div class="col-md-6">
                                        <button type="submit" @click.prevent="submitForgotPasswordNewPass" class="btn btn-success  mx-auto w-100">Modifier</button>
                                    </div>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
                <div class="modal-footer">

                </div>
                <div v-if="authSectionStepModal == 2" style="margin-top: -15px">
                    <p class="text-center"><span @click="changeAuthSectionStepModalToLogin" style="cursor: pointer; color: blue"> Se connecter</span></p>
                </div>
                <div v-else-if="authSectionStepModal == 1" style="margin-top: -15px">
                    <p class="text-center"><span @click="changeAuthSectionStepModalToForgotPassword" style="cursor: pointer; color: blue"> Mot de passe oublié ?</span></p>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import { mapGetters, mapActions} from "vuex";
import moment from 'moment'
import { QuillEditor } from '@vueup/vue-quill'
import '@vueup/vue-quill/dist/vue-quill.snow.css';
import VueMultiselect from 'vue-multiselect';

export default {

    components: {
        QuillEditor, VueMultiselect
    },

    data () {
        return {
            dataReady: 0,
            meRoleName: null,
            publicationCreateBySlugTypeShowData: {},
            publicationCreateBySlugTypeShowMessage: null,
            meProfileUserName: null,
            meProfileRoleName: null,
            authSectionModal: 'LIST',
            publicationStoreInfoAlertAnnonceCreateData: {},
            publicationStoreInfoAlertAnnonceCreateMessage: null,
            publicationStoreInfoAlertAnnonceCreateErrors: { },
            publicationStoreArticleFirstStepCreateData: {},
            publicationStoreArticleFirstStepCreateMessage: null,
            publicationStoreArticleFirstStepCreateErrors: { },
            categoryListData: {},
            categoryListMessage: null,
            categoryStoreData: {},
            categoryStoreMessage: null,
            categoryStoreErrors: [],
            tagsListData: {},
            tagsListMessage: null,
            tagsStoreData: {},
            tagsStoreMessage: null,
            tagsStoreErrors: [],
            username: null,
            email:null,
            password: null,
            password_confirm: null,
            loadingLogin: false,
            errorLogin: false,
            errorsLogin: [],
            loadingConnect: false,
            remember_me: false,
            authSectionStepModal: 1,
            loadingForgotPasswordFirst: false,
            errorForgotPasswordFirst: false,
            errorsForgotPasswordFirst: [],
            loadingForgotPasswordTwo: false,
            errorForgotPasswordTwo: false,
            errorsForgotPasswordTwo: [],
            loadingForgotPasswordThree: false,
            errorForgotPasswordThree: false,
            errorsForgotPasswordThree: [],
            step: 1,
            name: null,
            slug: null,
            loadingCreate: false,
            status: 1,
            title: null,
            author: null,
            category: null,
            categories: null,
            tag: null,
            tags: null,
            source: null,
            date_publish: null,
            date_publish_end: null,
            show_date_publish: false,
            show_date_publish_end: true,
            showPsw: false,
            showPswC: false,
            loadingPublicationStoreInfoAlertAnnonceCreate: false,
            loadingPublicationStoreArticleFirstStepCreate: false,
            loadingPublicationStoreArticleTwoStepCreate: false,
            config: {
                events: {
                    initialized: function () {
                    console.log('initialized')
                    }
                }
            },

            content: 'Redigez le contenu de votre publication!',
            stepStoreArticleFirst: true,
            stepStoreArticleTwo: false,
            stepStoreArticleThree: false,
        }
    },
    computed: {
        ...mapGetters("roleSecurity",{
            gettersMeRoleName:"getMeRoleName",
            gettersRoleStatus:'getRoleStatus',
        }),

        ...mapGetters('publicationAdmin',{
            getterInfosPublicationCreateBySlugTypeShowStatus:'getInfosPublicationCreateBySlugTypeShowStatus',
            getterInfosPublicationCreateBySlugTypeShowMessage:'getInfosPublicationCreateBySlugTypeShowMessage',
            getterInfosPublicationCreateBySlugTypeShowData:'getInfosPublicationCreateBySlugTypeShowData',
            getterInfosPublicationStoreInfoAlertAnnonceStatus:'getInfosPublicationStoreInfoAlertAnnonceStatus',
            getterInfosPublicationStoreInfoAlertAnnonceMessage:'getInfosPublicationStoreInfoAlertAnnonceMessage',
            getterInfosPublicationStoreInfoAlertAnnonceData:'getInfosPublicationStoreInfoAlertAnnonceData',
            getterInfosPublicationStoreInfoAlertAnnonceErrors:'getInfosPublicationStoreInfoAlertAnnonceErrors',
            getterInfosPublicationStoreArticleFirstStepStatus:'getInfosPublicationStoreArticleFirstStepStatus',
            getterInfosPublicationStoreArticleFirstStepMessage:'getInfosPublicationStoreArticleFirstStepMessage',
            getterInfosPublicationStoreArticleFirstStepData:'getInfosPublicationStoreArticleFirstStepData',
            getterInfosPublicationStoreArticleFirstStepErrors:'getInfosPublicationStoreArticleFirstStepErrors',

        }),
        ...mapGetters('categoryAdmin',{
            getterInfosCategoryListStatus:'getInfosCategoryListStatus',
            getterInfosCategoryListMessage:'getInfosCategoryListMessage',
            getterInfosCategoryListData:'getInfosCategoryListData',
            getterInfosCategoryStoreStatus:'getInfosCategoryStoreStatus',
            getterInfosCategoryStoreMessage:'getInfosCategoryStoreMessage',
            getterInfosCategoryStoreErrors:'getInfosCategoryStoreErrors',
            getterInfosCategoryStoreData:'getInfosCategoryStoreData',

        }),

        ...mapGetters('tagsAdmin',{
            getterInfosTagsListStatus:'getInfosTagsListStatus',
            getterInfosTagsListMessage:'getInfosTagsListMessage',
            getterInfosTagsListData:'getInfosTagsListData',
            getterInfosTagsStoreStatus:'getInfosTagsStoreStatus',
            getterInfosTagsStoreMessage:'getInfosTagsStoreMessage',
            getterInfosTagsStoreErrors:'getInfosTagsStoreErrors',
            getterInfosTagsStoreData:'getInfosTagsStoreData',

        }),
        ...mapGetters('login',{
            getterLoginStatus:'getLoginStatus',
            getterLoginMessage:'getLoginMessage',
            getterLoginErrors:'getLoginErrors',
        }),

        ...mapGetters("meProfile",{
            gettersMeProfileUserName:"getMeProfileUserName",
            gettersMeProfileRoleName:"getMeProfileRoleName",
            gettersProfileStatus:'getProfileStatus',
        }),

        ...mapGetters("forgot_password",{
            gettersSendOtpForgotPasswordStatus:'getSendOtpForgotPasswordStatus',
            gettersSendOtpForgotPasswordErrors:'getSendOtpForgotPasswordErrors',
            gettersSendOtpForgotPasswordMessage:'getSendOtpForgotPasswordMessage',
            gettersCheckOtpForgotPasswordStatus:'getCheckOtpForgotPasswordStatus',
            gettersCheckOtpForgotPasswordErrors:'getCheckOtpForgotPasswordErrors',
            gettersCheckOtpForgotPasswordMessage:'getCheckOtpForgotPasswordMessage',
            gettersNewPassOtpForgotPasswordStatus:'getNewPassOtpForgotPasswordStatus',
            gettersNewPassOtpForgotPasswordErrors:'getNewPassOtpForgotPasswordErrors',
            gettersNewPassOtpForgotPasswordMessage:'getNewPassOtpForgotPasswordMessage',
        }),

    },
    methods:{

        ...mapActions('login',{
            actionLogin:'login'
        }),

        ...mapActions("meProfile",{
            actionsGetMeProfile:'getMeProfile'
        }),

        ...mapActions("forgot_password",{
            actionsSendOtpForgotPassword:'sendOtpForgotPassword',
            actionsCheckOtpForgotPassword:'checkOtpForgotPassword',
            actionsNewPassOtpForgotPassword:'newPassOtpForgotPassword'
        }),

        ...mapActions("register",{
            actionsSendOtpRegister:'sendOtpRegister',
            actionsCheckOtpRegister:'checkOtpRegister',
            actionsNewInfoOtpRegister:'newInfoOtpRegister',
            actionsNewPassOtpRegister:'newPassOtpRegister'
        }),

        ...mapActions("roleSecurity",{
          actionsGetMeRole:'getMeRole'
        }),


        ...mapActions("categoryAdmin",{
          actionsCategoryListDataRequest:'categoryListDataRequest',
          actionsCategoryStoreDataRequest:'categoryStoreDataRequest',

        }),

        ...mapActions("tagsAdmin",{
          actionsTagsListDataRequest:'tagsListDataRequest',
          actionsTagsStoreDataRequest:'tagsStoreDataRequest',

        }),

        ...mapActions("publicationAdmin",{
          actionsPublicationCreateBySlugTypeShowDataRequest:'publicationCreateBySlugTypeShowDataRequest',
          actionsPublicationStoreInfoAlertAnnonceDataRequest:'publicationStoreInfoAlertAnnonceDataRequest',
          actionsPublicationStoreArticleFirstStepDataRequest:'publicationStoreArticleFirstStepDataRequest',
        }),

        buttonStepStoreArticleFirstToTwo ( ){

            this.stepStoreArticleFirst = false

            this.stepStoreArticleTwo = true

            this.stepStoreArticleThree = false

        },

        buttonStepStoreArticleTwoToThree ( ){

            this.stepStoreArticleFirst = false

            this.stepStoreArticleTwo = false

            this.stepStoreArticleThree = true

        },

        buttonStepStoreArticleThreeToTwo ( ){

            this.stepStoreArticleFirst = false

            this.stepStoreArticleTwo = true

            this.stepStoreArticleThree = false

        },

        buttonStepStoreArticleTwoToFirst ( ){

            this.stepStoreArticleFirst = true

            this.stepStoreArticleTwo = false

            this.stepStoreArticleThree = false

        },

        async handleSelectionSearchByStatus(event ){

            this.status = event.target.value

            if(this.status == 2){

                this.show_date_publish = true

                this.show_date_publish_end = true

                const date = new Date()

                this.date_publish = date.toISOString().slice(0, 16)
            }else{

                this.show_date_publish = false

                if(this.status == 0 || this.status ==3 ){

                    this.show_date_publish_end = false

                }else{

                    this.show_date_publish_end = true

                }

            }


        },

        showPassword(){
            var x = document.getElementById("psw-input");
            if (x.type === "password") {
                x.type = "text";
                this.showPsw = true
            } else {
                x.type = "password";
                this.showPsw = false
            }
        },

        showPasswordC(){
            var x = document.getElementById("psw-input_c");
            if (x.type === "password") {
                x.type = "text";
                this.showPsw = true
            } else {
                x.type = "password";
                this.showPsw = false
            }
        },

        authFormModalpublicationCreateBySlugTypeShowClose(){
            this.errorForgotPasswordFirst = null
            this.errorsForgotPasswordFirst = []
            this.errorForgotPasswordTwo = null
            this.errorsForgotPasswordTwo = []
            this.errorForgotPasswordThree = null
            this.errorsForgotPasswordThree = []
            this.errorLogin = false
            this.errorsLogin = []
            $('#authFormModalpublicationCreateBySlugTypeShow').modal('hide');
        },


        authModalClick(action_auth="LIST", name=null, slug=null){

            if(localStorage.getItem('remember_me') == "true" && localStorage.getItem('username') && localStorage.getItem('password')){

                this.username = localStorage.getItem('username')

                this.password = localStorage.getItem('password')

                this.remember_me = localStorage.getItem('remember_me')
            }

            this.name = name

            this.slug = slug

            this.authSectionModal= action_auth

            if(this.authSectionModal == "CREATEALERTINFOS"){

                this.loadingPublicationStoreInfoAlertAnnonceCreate = false

            }

            $('#authFormModalpublicationCreateBySlugTypeShow').modal('show');
        },

        PreviousForgotPasswordStep(){
            this.step = 1
            this.errorForgotPasswordFirst = null
            this.errorsForgotPasswordFirst = []
            this.errorForgotPasswordTwo = null
            this.errorsForgotPasswordTwo = []
            this.errorForgotPasswordThree = null
            this.errorsForgotPasswordThree = []
            this.errorLogin = false
            this.errorsLogin = []
        },

        PreviousHForgotPasswordStep(){
            this.step = 2
            this.errorForgotPasswordFirst = null
            this.errorsForgotPasswordFirst = []
            this.errorForgotPasswordTwo = null
            this.errorsForgotPasswordTwo = []
            this.errorForgotPasswordThree = null
            this.errorsForgotPasswordThree = []
            this.errorLogin = false
            this.errorsLogin = []
        },

        changeAuthSectionStepModalToForgotPassword(){
            this.errorForgotPasswordFirst = null
            this.errorsForgotPasswordFirst = []
            this.errorForgotPasswordTwo = null
            this.errorsForgotPasswordTwo = []
            this.errorForgotPasswordThree = null
            this.errorsForgotPasswordThree = []
            this.errorLogin = false
            this.errorsLogin = []
            this.authSectionStepModal = 2
        },

        changeAuthSectionStepModalToLogin(){
            this.errorForgotPasswordFirst = null
            this.errorsForgotPasswordFirst = []
            this.errorForgotPasswordTwo = null
            this.errorsForgotPasswordTwo = []
            this.errorForgotPasswordThree = null
            this.errorsForgotPasswordThree = []
            this.errorLogin = false
            this.errorsLogin = []
            this.authSectionStepModal = 1
        },

        async submitVerifyForgotPasswordEmail(){
            this.loadingForgotPasswordFirst = true
            this.errorForgotPasswordFirst = null
            this.errorsForgotPasswordFirst = []
            await this.actionsSendOtpForgotPassword({email:this.email});

            if(this.gettersSendOtpForgotPasswordStatus === 'success'){

                const Toast = this.$swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                        toast.addEventListener('mouseenter', this.$swal.stopTimer)
                        toast.addEventListener('mouseleave', this.$swal.resumeTimer)
                    }
                })

                Toast.fire({
                    icon: 'success',
                    title: this.gettersSendOtpForgotPasswordMessage
                })

                this.errorForgotPasswordFirst = null
                this.errorsForgotPasswordFirst = []

                this.loadingForgotPasswordFirst = false

                this.step = 2

            }else if(this.gettersSendOtpForgotPasswordStatus === 'failed'){

                this.errorsForgotPasswordFirst = this.gettersSendOtpForgotPasswordMessage

                this.errorsForgotPasswordFirst = []

                this.loadingForgotPasswordFirst = false

            }else if(this.gettersSendOtpForgotPasswordStatus === 'error'){

                this.errorForgotPasswordFirst = this.gettersSendOtpForgotPasswordMessage

                this.errorsForgotPasswordFirst = this.gettersSendOtpForgotPasswordErrors

                this.loadingForgotPasswordFirst = false
            }

            this.loadingForgotPasswordFirst = false
        },

        async submitResendOtp(){
            this.loadingResendOTP = true
            this.errorForgotPasswordFirst = null
            this.errorsForgotPasswordFirst = []
            await this.actionsSendOtpForgotPassword({email:this.email});

            if(this.gettersSendOtpForgotPasswordStatus === 'success'){

                const Toast = this.$swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                        toast.addEventListener('mouseenter', this.$swal.stopTimer)
                        toast.addEventListener('mouseleave', this.$swal.resumeTimer)
                    }
                })

                Toast.fire({
                    icon: 'success',
                    title: this.gettersSendOtpForgotPasswordMessage
                })

                this.errorForgotPasswordFirst = null
                this.errorsForgotPasswordFirst = []

                this.loadingResendOTP = false

                this.step = 2

            }else if(this.gettersSendOtpForgotPasswordStatus === 'failed'){

                this.errorForgotPasswordFirst = this.gettersSendOtpForgotPasswordMessage

                this.errorsForgotPasswordFirst = []

                this.loadingResendOTP = false

            }else if(this.gettersSendOtpForgotPasswordStatus === 'error'){

                this.errorForgotPasswordFirst = this.gettersSendOtpForgotPasswordMessage

                this.errorsForgotPasswordFirst = this.gettersSendOtpForgotPasswordErrors

                this.loadingResendOTP = false
            }

            this.loadingResendOTP = false
        },

        async submitVerifyForgotPasswordOtp(){
            this.loadingForgotPasswordTwo = true
            this.errorForgotPasswordTwo = null
            this.errorsForgotPasswordTwo = []
            await this.actionsCheckOtpForgotPassword({email:this.email, otp :this.otp });

            if(this.gettersCheckOtpForgotPasswordStatus === 'success'){

                const Toast = this.$swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                        toast.addEventListener('mouseenter', this.$swal.stopTimer)
                        toast.addEventListener('mouseleave', this.$swal.resumeTimer)
                    }
                })

                Toast.fire({
                    icon: 'success',
                    title: this.gettersCheckOtpForgotPasswordMessage
                })

                this.errorForgotPasswordTwo = null
                this.errorsForgotPasswordTwo = []

                this.loadingForgotPasswordTwo = false

                this.step = 3

            }else if(this.gettersCheckOtpForgotPasswordStatus === 'failed'){

                this.errorForgotPasswordTwo = this.gettersCheckOtpForgotPasswordMessage

                this.errorsForgotPasswordTwo = []

                this.loadingForgotPasswordTwo = false

            }else if(this.gettersCheckOtpForgotPasswordStatus === 'error'){

                this.errorForgotPasswordTwo = this.gettersCheckOtpForgotPasswordMessage

                this.errorsForgotPasswordTwo = this.gettersCheckOtpForgotPasswordErrors

                this.loadingForgotPasswordTwo = false
            }
            this.loadingForgotPasswordTwo = false
        },

        async submitForgotPasswordNewPass(){
            this.loadingForgotPasswordThree = true
            this.errorForgotPasswordThree = null
            this.errorsForgotPasswordThree = []
            await this.actionsNewPassOtpForgotPassword({email:this.email, otp :this.otp, password :this.password ,password_confirm :this.password_confirm});

            if(this.gettersNewPassOtpForgotPasswordStatus === 'success'){

                const Toast = this.$swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                        toast.addEventListener('mouseenter', this.$swal.stopTimer)
                        toast.addEventListener('mouseleave', this.$swal.resumeTimer)
                    }
                })

                Toast.fire({
                    icon: 'success',
                    title: this.gettersNewPassOtpForgotPasswordMessage
                })

                this.errorForgotPasswordThree = null
                this.errorsForgotPasswordThree = []

                this.authSectionStepModal = 1

            }else if(this.gettersNewPassOtpForgotPasswordStatus === 'failed'){

                this.errorForgotPasswordThree = this.gettersNewPassOtpForgotPasswordMessage

                this.errorsForgotPasswordThree = []

                this.loadingForgotPasswordThree = false

            }else if(this.gettersNewPassOtpForgotPasswordStatus === 'error'){

                this.errorForgotPasswordThree = this.gettersNewPassOtpForgotPasswordMessage

                this.errorsForgotPasswordThree = this.gettersNewPassOtpForgotPasswordErrors

                this.loadingForgotPasswordThree = false
            }
            this.loadingForgotPasswordThree = false

        },

        async submitLogin(){
            this.loadingLogin = true
            this.errorLogin = false
            this.errorsLogin = []
            await this.actionLogin({username:this.username, password:this.password, remember_me: this.remember_me});

            if(this.getterLoginStatus === 'success admin'){

                this.errorLogin = false
                this.errorsLogin = []

                if(this.remember_me){

                    localStorage.setItem('username', this.username )

                    localStorage.setItem('password', this.password)

                    localStorage.setItem('remember_me', true)

                    this.loadingLogin = false

                    const Toast = this.$swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true,
                        didOpen: (toast) => {
                            toast.addEventListener('mouseenter', this.$swal.stopTimer)
                            toast.addEventListener('mouseleave', this.$swal.resumeTimer)
                        }
                    })

                    Toast.fire({
                        icon: 'success',
                        title: this.getterLoginMessage
                    })



                     if(this.authSectionModal== 'LIST'){

                        $('#authFormModalpublicationCreateBySlugTypeShow').modal('hide');

                        this.getResults()

                    }else if(this.authSectionModal== 'UPDATE'){


                        this.authFormModalpublicationCreateBySlugTypeShowClose()
                        this.loadingPublicationStoreInfoAlertAnnonceCreate = true

                        thispublicationStoreInfoAlertAnnonceCreate()
                    }


                }else{

                    localStorage.setItem('remember_me', false)

                    this.loadingLogin = false

                    const Toast = this.$swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true,
                        didOpen: (toast) => {
                            toast.addEventListener('mouseenter', this.$swal.stopTimer)
                            toast.addEventListener('mouseleave', this.$swal.resumeTimer)
                        }
                    })

                    Toast.fire({
                        icon: 'success',
                        title: this.getterLoginMessage
                    })


                     if(this.authSectionModal== 'LIST'){

                        $('#authFormModalpublicationCreateBySlugTypeShow').modal('hide');

                        this.getResults()

                    }else if(this.authSectionModal== 'UPDATE'){


                        this.authFormModalpublicationCreateBySlugTypeShowClose()
                        this.loadingPublicationStoreInfoAlertAnnonceCreate = true

                        thispublicationStoreInfoAlertAnnonceCreate()
                    }
                }

            }else if(this.getterLoginStatus === 'success pub'){

                if(this.remember_me){

                    localStorage.setItem('username', this.username )

                    localStorage.setItem('password', this.password)

                    localStorage.setItem('remember_me', true)

                    this.loadingLogin = false

                    window.location = '/pub/dashboard'


                }else{

                    localStorage.setItem('remember_me', false)

                    this.loadingLogin = false

                    window.location = '/pub/dashboard'
                }



            }else if(this.getterLoginStatus === 'success visitor'){

                if(this.remember_me){

                    localStorage.setItem('username', this.username )

                    localStorage.setItem('password', this.password)

                    localStorage.setItem('remember_me', true)

                    this.loadingLogin = false

                    window.location = '/'


                }else{

                    localStorage.setItem('remember_me', false)

                    this.loadingLogin = false

                    window.location = '/'
                }



            }else if(this.getterLoginStatus === 'failed'){

                this.errorLogin = this.getterLoginMessage

                this.errorsLogin = []

                this.loadingLogin = false

            }else if(this.getterLoginStatus === 'error'){

                this.errorLogin = this.getterLoginMessage

                this.errorsLogin = this.getterLoginErrors

                this.loadingLogin = false
            }
        },

        async show(){

            if(localStorage.getItem('access_token') && localStorage.getItem('nbRsp')){

                await this.actionsGetMeRole();

                this.authSectionModal= 'LIST'

                if(this.gettersRoleStatus === 'success'){

                    this.meRoleName = this.gettersMeRoleName

                    if((this.meRoleName == localStorage.getItem('nbRsp')) && (localStorage.getItem('nbRsp') === '&nbtsd!?')){

                        this.getResults()

                    }else{

                        this.dataReady= 2

                    }

                }else if(this.gettersRoleStatus === 'failed'){

                    this.dataReady = 3;
                }

            }else{

                this.dataReady = 4;

            }

        },


        async getResults(page = 1){

            this.loading = true

            this.authSectionModal= 'LIST'

            await this.actionsPublicationCreateBySlugTypeShowDataRequest({slug : this.$route.params.slug});

            if( this.getterInfosPublicationCreateBySlugTypeShowStatus ==="success"){

                this.publicationCreateBySlugTypeShowData = this.getterInfosPublicationCreateBySlugTypeShowData

                this.categories = this.getterInfosPublicationCreateBySlugTypeShowData.categories

                this.tags = this.getterInfosPublicationCreateBySlugTypeShowData.tags

                this.empty = 0

                this.dataReady = 1

            }else if( this.getterInfosPublicationCreateBySlugTypeShowStatus ==="empty"){

                this.publicationCreateBySlugTypeShowMessage = this.getterInfosPublicationCreateBySlugTypeShowMessage

                this.publicationCreateBySlugTypeShowData = this.getterInfosPublicationCreateBySlugTypeShowData

                this.empty = 1

                this.dataReady = 1

            }else if(this.getterInfosPublicationCreateBySlugTypeShowStatus === 'failed'){

                this.dataReady = 3;

            }else{

                this.publicationCreateBySlugTypeShowMessage = this.getterInfosPublicationCreateBySlugTypeShowMessage

                this.empty = 3

                this.dataReady = 4

            }

        },

        cancelFirst(){
            this.title = null,
            this.status = 1,
            this.date_publish = null
            this.show_date_publish = false
            this.show_date_publish_end = true
        },

         async publicationStoreInfoAlertAnnonce(){

            this.loadingPublicationStoreInfoAlertAnnonceCreate = true

            this.authSectionModal= 'CREATEALERTINFOS'

            if(localStorage.getItem('access_token') && localStorage.getItem('nbRsp')){

                await this.actionsGetMeRole();

                if(this.gettersRoleStatus === 'success'){

                    this.meRoleName = this.gettersMeRoleName

                    if((this.meRoleName == localStorage.getItem('nbRsp')) && (localStorage.getItem('nbRsp') === '&nbtsd!?')){

                        this.publicationStoreInfoAlertAnnonceCreate()

                    }else{

                        this.authModalClick('CREATEALERTINFOS')

                    }

                }else if(this.gettersRoleStatus === 'failed'){

                    this.authModalClick('CREATEALERTINFOS')
                }

            }else{

                this.authModalClick('CREATEALERTINFOS')

            }

        },

        async publicationStoreInfoAlertAnnonceCreate(){

            this.loadingPublicationStoreInfoAlertAnnonceCreate = true

            this.authSectionModal= 'CREATEALERTINFOS'

            this.publicationStoreInfoAlertAnnonceCreateMessage =  null
            this.publicationStoreInfoAlertAnnonceCreateErrors = []

            if(this.status == 1){
                const date = new Date()

                this.date_publish = date.toISOString().slice(0, 16)
            }

            await this.actionsPublicationStoreInfoAlertAnnonceDataRequest({ slug : this.$route.params.slug, title : this.title, status : this.status, date_publish : this.date_publish,  date_publish_end : this.date_publish_end  });

            if( this.getterInfosPublicationStoreInfoAlertAnnonceStatus ==="success"){

                this.publicationStoreInfoAlertAnnonceCreateData = this.getterInfosPublicationStoreInfoAlertAnnonceData

                this.publicationStoreInfoAlertAnnonceCreateMessage =  null
                this.publicationStoreInfoAlertAnnonceCreateErrors = []
                this.title = null
                this.status = 1
                this.date_publish = null,
                this.date_publish_end = null

                const Toast = this.$swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                        toast.addEventListener('mouseenter', this.$swal.stopTimer)
                        toast.addEventListener('mouseleave', this.$swal.resumeTimer)
                    }
                })

                Toast.fire({
                    icon: 'success',
                    title: this.getterInfosPublicationStoreInfoAlertAnnonceMessage
                })

                this.loadingPublicationStoreInfoAlertAnnonceCreate = false

                this.publicationStoreInfoAlertAnnonceCreateMessage =  null
                this.publicationStoreInfoAlertAnnonceCreateErrors = []

            }else if( this.getterInfosPublicationStoreInfoAlertAnnonceStatus ==="empty"){

                this.publicationStoreInfoAlertAnnonceCreateMessage = this.getterInfosPublicationStoreInfoAlertAnnonceMessage

                this.publicationStoreInfoAlertAnnonceCreateErrors = this.getterInfosPublicationStoreInfoAlertAnnonceErrors

                this.loadingPublicationStoreInfoAlertAnnonceCreate = false


            }else if( this.getterInfosPublicationStoreInfoAlertAnnonceStatus ==="error"){

                this.publicationStoreInfoAlertAnnonceCreateMessage = this.getterInfosPublicationStoreInfoAlertAnnonceMessage

                this.publicationStoreInfoAlertAnnonceCreateErrors = []

                this.loadingPublicationStoreInfoAlertAnnonceCreate = false

            }
        },

        cancelArticleFirst(){

            this.author = null
            this.category = null
            this.source = null
            this.title  = null

        },

         cancelArticleTwo(){

            this.content = null
            this.tag = null


        },

        async addCategory (newCategory) {
            const category = {
                name: newCategory,
            }
            await this.actionsCategoryStoreDataRequest({ name : newCategory});

            if( this.getterInfosCategoryStoreStatus ==="success"){

                this.categories.push(this.getterInfosCategoryStoreData.categoryCreateData)

                this.category.push(this.getterInfosCategoryStoreData.categoryCreateData)

            }

        },

        async addTag (newTag) {
            const tag = {
                name: newTag,
            }
            await this.actionsTagsStoreDataRequest({ name : newTag});

            if( this.getterInfosTagsStoreStatus ==="success"){


                this.tags.push(this.getterInfosTagsStoreData.tagCreateData)

                this.tag.push(this.getterInfosTagsStoreData.tagCreateData)

            }

        },

         async publicationStoreArticleFirstStep(){

         },


        async publicationStoreArticleFirstStep(){

            this.loadingPublicationStoreArticleFirstStepCreate = true

            this.authSectionModal= 'CREATEARTICLE'

            if(localStorage.getItem('access_token') && localStorage.getItem('nbRsp')){

                await this.actionsGetMeRole();

                if(this.gettersRoleStatus === 'success'){

                    this.meRoleName = this.gettersMeRoleName

                    if((this.meRoleName == localStorage.getItem('nbRsp')) && (localStorage.getItem('nbRsp') === '&nbtsd!?')){

                        this.publicationStoreArticleFirstStepCreate()

                    }else{

                        this.authModalClick('CREATEARTICLE')

                    }

                }else if(this.gettersRoleStatus === 'failed'){

                    this.authModalClick('CREATEARTICLE')
                }

            }else{

                this.authModalClick('CREATEARTICLE')

            }

        },


        async publicationStoreArticleFirstStepCreate(){

           this.authSectionModal= 'CREATEARTICLE'

            this.publicationStoreArticleFirstStepCreateMessage =  null
            this.publicationStoreArticleFirstStepCreateErrors = []



            await this.actionsPublicationStoreArticleFirstStepDataRequest({ slug : this.$route.params.slug, title : this.title, source : this.source, author : this.author,  category : this.category ,  tag : this.tag });


            if( this.getterInfosPublicationStoreArticleFirstStepStatus ==="success"){

                const Toast = this.$swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                        toast.addEventListener('mouseenter', this.$swal.stopTimer)
                        toast.addEventListener('mouseleave', this.$swal.resumeTimer)
                    }
                })

                Toast.fire({
                    icon: 'success',
                    title: this.getterInfosPublicationStoreArticleFirstStepMessage
                })

                this.loadingPublicationStoreArticleFirstStepCreate = false

                this.publicationStoreArticleFirstStepCreateMessage =  null
                this.publicationStoreArticleFirstStepCreateErrors = []

            }else if( this.getterInfosPublicationStoreArticleFirstStepStatus ==="empty"){

                this.publicationStoreArticleFirstStepCreateMessage = this.getterInfosPublicationStoreArticleFirstStepMessage

                this.publicationStoreArticleFirstStepCreateErrors = this.getterInfosPublicationStoreArticleFirstStepErrors

                this.loadingPublicationStoreArticleFirstStepCreate = false


            }else if( this.getterInfosPublicationStoreArticleFirstStepStatus ==="error"){

                this.publicationStoreArticleFirstStepCreateMessage = this.getterInfosPublicationStoreArticleFirstStepMessage

                this.publicationStoreArticleFirstStepCreateErrors = []

                this.loadingPublicationStoreArticleFirstStepCreate = false

            }

        },

    },
    mounted() {

        this.moment = moment
        this.show();
    },
};
</script>

<style src="vue-multiselect/dist/vue-multiselect.css"></style>
