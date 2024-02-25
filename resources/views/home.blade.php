<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

        <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

        @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/js/home.js'])
    </head>
    <body>
        <div class="d-flex justify-content-center p-3">
            <div class="card py-2 border-0 w-100 flex-row justify-content-end">
                <h5 class="w-100 text-center fs-2 fw-bold bg-transparent border-0">Post List</h5>
                <div class="d-flex align-items-center">
                    <div class="dropdown">
                        <button id="dropdown-trigger" class="btn bg-primary text-white dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
                                <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0"/>
                                <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8m8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1"/>
                            </svg>
                        </button>
                        <ul class="dropdown-menu text-center">
                          <li><button id="user-email" class="dropdown-item" type="button">Email User</button></li>
                          <li><button id="logout-btn" class="dropdown-item" type="button">Logout</button></li>
                        </ul>
                      </div>
                </div>
            </div>
        </div>
        <div id="post-item-wrapper" class="post-item-wrapper d-flex flex-row flex-wrap justify-space-between p-3 rounded border-info-subtle w-100"></div>
        <template id="post-item-template">
            <div id="post-item" class="post-item p-2 w-50">
                <div class="d-flex flex-column justify-content-around p-4 border shadow hover-shadow-lg h-100">
                    <div class="row">
                        <h3 id="post-title" class="text-primary-subtle fs-4 border-start border-primary border-3">Post Title</h3>
                    </div>
                    <div class="post-detail d-flex">
                        <div class="d-flex justify-content-center w-100">
                            <img id="post-image" class="post-detail-thumbnail img-thumbnail rounded-lg" height="180" width="260" src="http://placehold.it/260x180" alt="">
                        </div>
                        <div class="post-detail-conntent row px-4">
                            <div class="d-flex align-items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-person-lines-fill text-info-emphasis" viewBox="0 0 16 16">
                                    <path d="M6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6m-5 6s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1zM11 3.5a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1h-4a.5.5 0 0 1-.5-.5m.5 2.5a.5.5 0 0 0 0 1h4a.5.5 0 0 0 0-1zm2 3a.5.5 0 0 0 0 1h2a.5.5 0 0 0 0-1zm0 3a.5.5 0 0 0 0 1h2a.5.5 0 0 0 0-1z"/>
                                </svg>
                                <p id="post-author-name" class="text-info-emphasis fs-5 ms-2 text-left mb-0">Author Name</p>
                            </div>
                            <div class="d-flex align-items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-bookmark-fill text-info-emphasis" viewBox="0 0 16 16">
                                    <path d="M2 2v13.5a.5.5 0 0 0 .74.439L8 13.069l5.26 2.87A.5.5 0 0 0 14 15.5V2a2 2 0 0 0-2-2H4a2 2 0 0 0-2 2"/>
                                </svg>
                                <p id="post-category" class=" fs-5 ms-2 text-left mb-0">Category</p>
                            </div>
                            <div class="d-flex align-items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-calendar-fill text-info-emphasis" viewBox="0 0 16 16">
                                    <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V5h16V4H0V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5"/>
                                </svg>
                                <p id="post-date" class=" fs-5 ms-2 text-left mb-0">Date</p>
                            </div>
                            <div class="d-flex align-items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-clock-fill text-info-emphasis" viewBox="0 0 16 16">
                                    <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0M8 3.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 8.71z"/>
                                </svg>
                                <span id="post-time" class=" fs-5 ms-2 text-left">Time</span>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex pt-2 align-items-start">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-tags-fill text-info-emphasis mt-1" viewBox="0 0 16 16">
                            <path d="M2 2a1 1 0 0 1 1-1h4.586a1 1 0 0 1 .707.293l7 7a1 1 0 0 1 0 1.414l-4.586 4.586a1 1 0 0 1-1.414 0l-7-7A1 1 0 0 1 2 6.586zm3.5 4a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3"/>
                            <path d="M1.293 7.793A1 1 0 0 1 1 7.086V2a1 1 0 0 0-1 1v4.586a1 1 0 0 0 .293.707l7 7a1 1 0 0 0 1.414 0l.043-.043z"/>
                          </svg>
                          <div id="tags-item-wrapper">
                              <p id="tag-item" class="badge text-bg-primary p-2 ms-2">Tags</p>
                          </div>
                    </div>
                    <div class="accordion" id="accordionExample">
                        <div class="accordion-item">
                          <h2 class="accordion-header">
                            <button id="accordionTrigger" class="d-flex justify-content-between align-items-center bg-transparent border-0 fs-5 px-4 py-3 w-100" type="button" data-bs-toggle="collapse" data-bs-target="#accrodionItem" aria-expanded="true" aria-controls="collapseOne">
                              Deskripsi
                                <svg xmlns="http://www.w3.org/2000/svg" width="23" height="23" fill="currentColor" class="bi bi-eye-fill" viewBox="0 0 16 16">
                                    <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0"/>
                                    <path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8m8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7"/>
                                </svg>
                            </button>
                          </h2>
                          <div id="accrodionItem" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                            <div class="accordion-body" id="post-body">
                              <strong>This is the first item's accordion body.</strong> It is shown by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. It's also worth noting that just about any HTML can go within the <code>.accordion-body</code>, though the transition does limit overflow.
                            </div>
                          </div>
                        </div>
                    </div>
                </div>
            </div>
        </template>
    </body>
</html>
