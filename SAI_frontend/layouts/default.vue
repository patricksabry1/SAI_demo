<template>
    <div>
        <GlobalHeader />
        <div class="main-content">
            <b-container>
                <Nuxt />
            </b-container>
        </div>
        <GlobalFooter />
    </div>
</template>

<script>
    import GlobalHeader from '@/components/layout/GlobalHeader';
    import GlobalFooter from '@/components/layout/GlobalFooter';

    export default {
        components: {
            GlobalHeader,
            GlobalFooter,
        },
    };
</script>
