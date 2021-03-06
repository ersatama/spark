@extends('layouts.main')
@section('content')
    <div class="bg-container">
        <div class="bg-container-shadow">
            <div class="container main-page">
                <div class="row pt-5 pb-5">
                    <div class="col-12 col-md-6 pt-1 pb-1">
                        <div class="main-page-form"></div>
                    </div>
                    <div class="col-12 col-md-6 pt-1 pb-1">
                        <div class="main-page-content" data-aos="fade-down">
                            <div class="main-page-content-title">
                                <div class="main-page-content-title-header">ДОСТАВИМ ЛЮБОЙ ГРУЗ.</div>
                                <div class="main-page-content-title-desc">БЫСТРО. КАЧЕСТВЕННО. В СРОК.</div>
                                <div class="main-page-content-title-content">Сами заберем, упакуем, разместим на складах, доставим до получателя. В логистике мы 10 лет, за этот период мы развили собственную сеть, что позволяет отслеживать груз на протяжении всей перевозки, доставлять в срок, реализовывать грузовые перевозки и в страны Таможенного Союза и Европы.</div>
                                <a href="/services">
                                    <button class="main-page-content-title-btn">Наши услуги</button>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('services.layouts.services')
    <div class="bg-deliver">
        <div class="container">
            <h1 class="bg-deliver-title">ЧТО ДОСТАВЛЯЕМ</h1>
            <div class="bg-deliver-desc">Мы доставим что угодно, куда угодно. Доставляем любой объём, организовываем переезды. Перевозим груз любой сложности, габаритов и материалов. Работаем с физическими и юридическими лицами.</div>
            <div class="bg-deliver-list">
                <div class="row">
                    <div class="col-6 col-md-3">
                        <div class="bg-deliver-list-item" data-aos="flip-left">
                            <div class="bg-deliver-list-item-wallpaper">
                                <div class="bg-deliver-list-item-title">НЕБОЛЬШИЕ ПОСЫЛКИ</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-md-3">
                        <div class="bg-deliver-list-item" data-aos="flip-left" data-aos-delay="100">
                            <div class="bg-deliver-list-item-wallpaper bg-deliver-list-item-wallpaper-1">
                                <div class="bg-deliver-list-item-title">СТАНДАРТНЫЕ РАЗМЕРЫ</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-md-3">
                        <div class="bg-deliver-list-item" data-aos="flip-left" data-aos-delay="200">
                            <div class="bg-deliver-list-item-wallpaper bg-deliver-list-item-wallpaper-2">
                                <div class="bg-deliver-list-item-title">БОЛЬШИЕ ОБЪЕКТЫ</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-md-3">
                        <div class="bg-deliver-list-item" data-aos="flip-left" data-aos-delay="300">
                            <div class="bg-deliver-list-item-wallpaper bg-deliver-list-item-wallpaper-3">
                                <div class="bg-deliver-list-item-title">ГРУЗ ЛЮБОЙ СЛОЖНОСТИ</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="bg-characteristics">
        <div class="bg-characteristics-screen">
            <h1 class="bg-characteristics-title">НАШИ ХАРАКТЕРИСТИКИ</h1>
            <div class="bg-characteristics-desc">Узнайте о ключевых преимуществах сотрудничества с нами</div>
            <div class="bg-characteristics-list">
                <div class="container">
                    <div class="row">
                        <div class="col-12 col-md-4 mt-1">
                            <div class="bg-characteristics-list-item" data-aos="flip-left">
                                <div class="bg-characteristics-list-item-icon">
                                    <i class="fas fa-users"></i>
                                </div>
                                <div class="bg-characteristics-list-item-title">КОМАНДА ПРОФЕССИОНАЛОВ</div>
                                <div class="bg-characteristics-list-item-desc"> Заряженная на результат команда работает над улучшением вашего опыта.</div>
                            </div>
                        </div>
                        <div class="col-12 col-md-4 mt-1">
                            <div class="bg-characteristics-list-item" data-aos="flip-left" data-aos-delay="50">
                                <div class="bg-characteristics-list-item-icon">
                                    <i class="fas fa-code"></i>
                                </div>
                                <div class="bg-characteristics-list-item-title">ТЕХНОЛОГИИ</div>
                                <div class="bg-characteristics-list-item-desc">Мы технологичная логистическая компания и не боимся сложных проектов.</div>
                            </div>
                        </div>
                        <div class="col-12 col-md-4 mt-1">
                            <div class="bg-characteristics-list-item" data-aos="flip-left" data-aos-delay="100">
                                <div class="bg-characteristics-list-item-icon">
                                    <i class="far fa-smile"></i>
                                </div>
                                <div class="bg-characteristics-list-item-title">КОНКУРЕНТНЫЕ ЦЕНЫ</div>
                                <div class="bg-characteristics-list-item-desc">Уникальные тарифы. Скидки на определённые направления.</div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-5">
                        <div class="col-12 col-md-4 mt-1">
                            <div class="bg-characteristics-list-item" data-aos="flip-left" data-aos-delay="150">
                                <div class="bg-characteristics-list-item-icon">
                                    <i class="far fa-calendar-alt"></i>
                                </div>
                                <div class="bg-characteristics-list-item-title">ЛИЧНЫЙ КАБИНЕТ</div>
                                <div class="bg-characteristics-list-item-desc">Управляйте продукцией из личного кабинета. Оставляйте заявку на перевозку и управляйте своим складом онлайн.</div>
                            </div>
                        </div>
                        <div class="col-12 col-md-4 mt-1">
                            <div class="bg-characteristics-list-item" data-aos="flip-left" data-aos-delay="200">
                                <div class="bg-characteristics-list-item-icon">
                                    <i class="fas fa-award"></i>
                                </div>
                                <div class="bg-characteristics-list-item-title">ГАРАНТИЯ</div>
                                <div class="bg-characteristics-list-item-desc">Наши партнёры выбирают нас за надёжность и качество.</div>
                            </div>
                        </div>
                        <div class="col-12 col-md-4 mt-1">
                            <div class="bg-characteristics-list-item" data-aos="flip-left" data-aos-delay="250">
                                <div class="bg-characteristics-list-item-icon">
                                    <i class="fas fa-map-marked-alt"></i>
                                </div>
                                <div class="bg-characteristics-list-item-title">ДОСТАВЛЯЕМ ВЕЗДЕ</div>
                                <div class="bg-characteristics-list-item-desc">Обеспечиваем обработку и оформление груза в стране отправления, забор и доставку груза до получателя в стране назначения.</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="bg-contacts">
        <div class="container mb-3">
            <h1 class="bg-deliver-title">КОНТАКТЫ</h1>
            <div class="bg-deliver-desc">Позвольте помочь вам</div>
            <div class="bg-contacts-list">
                <div class="row">
                    <div class="col-6">
                        <div class="bg-contacts-list-item" data-aos="flip-left">
                            <div class="bg-contacts-list-item-icon">
                                <i class="far fa-envelope-open"></i>
                            </div>
                            <div class="bg-contacts-list-item-title">EMAIL</div>
                            <div class="bg-contacts-list-item-desc">info@spark-logistics.com</div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="bg-contacts-list-item" data-aos="flip-right">
                            <div class="bg-contacts-list-item-icon">
                                <i class="fas fa-phone"></i>
                            </div>
                            <div class="bg-contacts-list-item-title">КОНТАКТЫ</div>
                            <div class="bg-contacts-list-item-desc">info@spark-logistics.com</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
