<template>

    <div>
        <Header />
        <div class="container-fluid page-body-wrapper">
                <!--Container-->
            <div class="container w-full mx-auto pt-20">
                <Nav />
                <slot></slot>
            </div>
            <Footer />
        </div>
    </div>

</template>


<script>

    import Header  from '../parts/header'
    import Nav from '../parts/nav'
    import Footer from '../parts/footer'
    import Message from '../components/message'
    export default {
        name: "app-layout",
        props: {
        },
        components: { Header, Nav, Footer, Message },
        mounted(){  }

    }
</script>
