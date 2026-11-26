<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="Read the City of Ilagan College mission, vision, dedication, and institutional administration inscription.">
        <title>Mission, Vision &amp; Dedication | {{ config('app.name', 'CIC') }}</title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="bg-stone-50 font-sans text-slate-950 antialiased">
        <a class="sr-only focus:not-sr-only focus:fixed focus:left-4 focus:top-4 focus:z-50 focus:rounded-full focus:bg-white focus:px-4 focus:py-2 focus:text-sm focus:font-semibold focus:text-cic-blue-dark focus:shadow-lg" href="#main-content">Skip to content</a>
        @include('partials.public-nav')
        <main id="main-content">
            <section class="cic-tablet-wall px-5 py-8 sm:px-8 sm:py-12">
                <div class="mx-auto max-w-[96rem]">
                    <header class="mx-auto max-w-3xl text-center">
                        <p class="cic-eyebrow">City of Ilagan College</p>
                        <h1 class="cic-display mt-3 text-4xl font-semibold text-cic-blue-dark sm:text-5xl">Mission, Vision &amp; Dedication</h1>
                    </header>

                    <div class="mt-8 grid items-stretch gap-4 lg:grid-cols-2 xl:grid-cols-3">
                        <article class="cic-tablet-frame">
                            <div class="cic-tablet-face flex flex-col items-center px-5 pt-10 pb-8 sm:px-7">
                                <span class="cic-tablet-fastener left-3 top-3" aria-hidden="true"></span>
                                <span class="cic-tablet-fastener right-3 top-3" aria-hidden="true"></span>
                                <span class="cic-tablet-fastener bottom-3 left-3" aria-hidden="true"></span>
                                <span class="cic-tablet-fastener bottom-3 right-3" aria-hidden="true"></span>
                                <img class="mb-4 size-14 object-contain" src="{{ asset('images/cic-logo.png') }}" alt="City of Ilagan College seal" loading="lazy">
                                <p class="text-[0.68rem] font-semibold uppercase leading-5 tracking-[0.12em] text-amber-100">Republic of the Philippines<br>City of Ilagan<br>Province of Isabela</p>
                                <h2 class="cic-tablet-heading mt-5">Dedication</h2>
                                <div class="cic-tablet-rule"></div>
                                <div class="cic-tablet-copy space-y-2">
                                    <p>With hearts steadfast in hope, the City of Ilagan College is hereby dedicated to the people of Ilagan, who fought relentlessly with strong resolve and collective pride to reclaim our rightful place as the capital of the Province of Isabela—proud of our heritage, steadfast in our purpose, and united in our pursuits of progress.</p>
                                    <p>From our humble beginnings to the promise of what lies ahead, this edifice stands as a witness and declaration: that education shall no longer be a privilege, but a right made real. This institution shall serve as a dynamic equalizer, a pathway to dignity, and a foundation upon which lives are transformed and communities are uplifted.</p>
                                    <p class="font-semibold">The doors once closed shall now stand open—not for the few, but for all.</p>
                                    <p>May minds awaken and courage take root. May dreams once whispered grow into voices claiming victory. May this legacy of learning and hope endure, guiding generations to come!</p>
                                </div>
                                <div class="mt-6">
                                    <p class="text-sm font-bold uppercase tracking-[0.08em] text-amber-100">Hon. Josemarie L. Diaz, DMD, MBA</p>
                                    <p class="mt-1 text-xs font-semibold italic tracking-[0.12em] text-amber-200">City Mayor</p>
                                </div>
                            </div>
                        </article>

                        <article class="cic-tablet-frame">
                            <div class="cic-tablet-face flex flex-col items-center px-5 py-8 sm:px-7">
                                <span class="cic-tablet-fastener left-3 top-3" aria-hidden="true"></span>
                                <span class="cic-tablet-fastener right-3 top-3" aria-hidden="true"></span>
                                <span class="cic-tablet-fastener bottom-3 left-3" aria-hidden="true"></span>
                                <span class="cic-tablet-fastener bottom-3 right-3" aria-hidden="true"></span>
                                <h2 class="cic-tablet-copy max-w-3xl text-center text-base font-bold leading-6">This edifice was built during the administration of</h2>
                                <div class="cic-tablet-rule my-3"></div>
                                <div class="w-full space-y-2 text-center">
                                    <div>
                                        <p class="text-sm font-bold uppercase leading-5 text-amber-100">Hon. Josemarie L. Diaz, DMD, MBA</p>
                                        <p class="text-xs italic text-amber-200">City Mayor</p>
                                    </div>
                                    <div>
                                        <p class="text-sm font-bold uppercase leading-5 text-amber-100">Hon. Jay Eveson C. Diaz, RN, DPA</p>
                                        <p class="text-xs italic text-amber-200">City Vice Mayor</p>
                                    </div>
                                </div>
                                <div class="cic-tablet-rule my-3"></div>
                                <div class="w-full space-y-3">
                                    <section aria-labelledby="council-members-heading">
                                        <h3 id="council-members-heading" class="cic-tablet-section-heading">Sangguniang Panlungsod Members</h3>
                                        <div class="mt-1 grid grid-cols-1 gap-x-3 gap-y-2 sm:grid-cols-2">
                                            <div>
                                                <p class="cic-tablet-section-heading text-xs">Left Column</p>
                                                <ul class="cic-tablet-roster mt-1 space-y-1">
                                                    <li>Hon. Rachel V. Garcia, RSW</li>
                                                    <li>Hon. Harold P. Ojada, CE</li>
                                                    <li>Hon. Lillian Q. Bringas, MD, RN, MAN</li>
                                                    <li>Hon. Rolando E. Tugade</li>
                                                    <li>Hon. Gaylor M. Malunay</li>
                                                </ul>
                                            </div>
                                            <div>
                                                <p class="cic-tablet-section-heading text-xs">Right Column</p>
                                                <ul class="cic-tablet-roster mt-1 space-y-1">
                                                    <li>Hon. Keryll S. Bello</li>
                                                    <li>Hon. Ma. Josephine B. Borromeo</li>
                                                    <li>Hon. Antonio T. Manaligod, Jr.</li>
                                                    <li>Hon. Perlita G. Gaoiran</li>
                                                    <li>Hon. Perpetual Ma. Victoria L. Albano</li>
                                                </ul>
                                            </div>
                                        </div>
                                        <p class="mt-1 text-center text-[0.58rem] italic leading-4 text-amber-200">Some letters in the engraved names are affected by reflections; these spellings are best readings of the photograph.</p>
                                    </section>

                                    <section aria-labelledby="ex-officio-heading">
                                        <h3 id="ex-officio-heading" class="cic-tablet-section-heading">Ex-Officio Members</h3>
                                        <dl class="cic-tablet-roster mt-1 grid grid-cols-1 gap-x-3 gap-y-1 sm:grid-cols-2">
                                            <div>
                                                <dt class="font-semibold">Hon. Evelyn C. Diaz, RPT, RN</dt>
                                                <dd class="cic-tablet-role">Sectoral Representative – Women</dd>
                                            </div>
                                            <div>
                                                <dt class="font-semibold">Hon. Jessamyn Uy-Ligan, LL.M.</dt>
                                                <dd class="cic-tablet-role">Sectoral Representative – Trade &amp; Industry</dd>
                                            </div>
                                            <div>
                                                <dt class="font-semibold">Hon. Ariel B. Tabangcura</dt>
                                                <dd class="cic-tablet-role">Sectoral Representative – Labor</dd>
                                            </div>
                                            <div>
                                                <dt class="font-semibold">Hon. Daniel Joseph A. Mata</dt>
                                                <dd class="cic-tablet-role">Sectoral Representative – Indigenous People</dd>
                                            </div>
                                            <div>
                                                <dt class="font-semibold">Hon. Gerryme M. Servilla, LPT</dt>
                                                <dd class="cic-tablet-role">President, Liga ng mga Barangay</dd>
                                            </div>
                                            <div>
                                                <dt class="font-semibold">Hon. Eroll John R. Nebalasca</dt>
                                                <dd class="cic-tablet-role">President, Sangguniang Kabataan Federation</dd>
                                            </div>
                                        </dl>
                                    </section>

                                    <section aria-labelledby="project-management-heading">
                                        <h3 id="project-management-heading" class="cic-tablet-section-heading">Project Management Team</h3>
                                        <dl class="cic-tablet-roster mt-1 grid grid-cols-1 gap-x-3 gap-y-1 sm:grid-cols-2">
                                            <div>
                                                <dt class="font-semibold">Engr. Crisanta D. Concepcion</dt>
                                                <dd class="cic-tablet-role">City Planning &amp; Development Coordinator</dd>
                                            </div>
                                            <div>
                                                <dt class="font-semibold">Engr. Garry D. Cabanilla</dt>
                                                <dd class="cic-tablet-role">City Engineer</dd>
                                            </div>
                                            <div>
                                                <dt class="font-semibold">Ricky C. Laggui</dt>
                                                <dd class="cic-tablet-role">City General Services Officer</dd>
                                            </div>
                                            <div>
                                                <dt class="font-semibold">Ar. Isagani S. Magaoay</dt>
                                                <dd class="cic-tablet-role">City Architect</dd>
                                            </div>
                                        </dl>
                                    </section>

                                    <section aria-labelledby="project-implementing-heading">
                                        <h3 id="project-implementing-heading" class="cic-tablet-section-heading">Project Implementing Team</h3>
                                        <div class="mt-1 grid grid-cols-1 gap-x-3 sm:grid-cols-2">
                                            <ul class="cic-tablet-roster space-y-1">
                                                <li>Paterio C. Alamo</li>
                                                <li>Engr. Leo Magudang</li>
                                                <li>Engr. Mariel Prudencio</li>
                                                <li>Engr. Roehl Richard Manalo III</li>
                                                <li>Jomer Sayangda</li>
                                            </ul>
                                            <ul class="cic-tablet-roster space-y-1">
                                                <li>Engr. Jefferson V. Garcia</li>
                                                <li>Engr. Arlene Magudang</li>
                                                <li>Engr. Jimlord Balisi</li>
                                                <li>Raymond C. Lozada</li>
                                                <li>John Jonard Miranda</li>
                                            </ul>
                                        </div>
                                    </section>

                                    <section aria-labelledby="project-designer-heading">
                                        <h3 id="project-designer-heading" class="cic-tablet-section-heading">Project Designer</h3>
                                        <p class="cic-tablet-roster mt-1 text-center font-semibold">Ar. Tristan James A. Flores</p>
                                    </section>
                                </div>
                            </div>
                        </article>

                        <article class="cic-tablet-frame">
                            <div class="cic-tablet-face flex flex-col items-center px-5 py-12 sm:px-7">
                                <span class="cic-tablet-fastener left-3 top-3" aria-hidden="true"></span>
                                <span class="cic-tablet-fastener right-3 top-3" aria-hidden="true"></span>
                                <span class="cic-tablet-fastener bottom-3 left-3" aria-hidden="true"></span>
                                <span class="cic-tablet-fastener bottom-3 right-3" aria-hidden="true"></span>
                                <img class="mb-4 size-14 object-contain" src="{{ asset('images/cic-logo.png') }}" alt="City of Ilagan College seal" loading="lazy">
                                <h2 class="cic-tablet-heading">Vision</h2>
                                <p class="cic-tablet-copy mt-5">A premier higher educational institution in Asia that develops holistic, research-driven, and globally competitive professionals and leaders for a livable City of Ilagan.</p>
                                <div class="cic-tablet-rule"></div>
                                <h2 class="cic-tablet-heading">Mission</h2>
                                <p class="cic-tablet-copy mt-5">To provide exceptional learning experiences that uphold academic excellence, integrity, and equity within a safe, supportive environment, while cultivating a culture of research, creativity, innovation, social responsibility, and civic engagement.</p>
                            </div>
                        </article>
                    </div>
                </div>
            </section>
        </main>
        @include('partials.public-footer')
    </body>
</html>
