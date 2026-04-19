<template>
    <Head :title="t('userDeletionMetaTitle')" />

    <NavBar logoSrc="/asset/logo-new-white.png" textColor="white" backgroundColor="black" />

    <div class="min-h-screen bg-black pt-16">
        <section class="py-16 px-4 bg-black border-b border-gray-800">
            <div class="max-w-4xl mx-auto text-center">
                <h1 class="text-4xl md:text-5xl font-bold bg-gradient-to-r from-blue-400 to-purple-400 bg-clip-text text-transparent mb-4">
                    {{ t('userDeletionHeroTitle') }}
                </h1>
                <p class="text-gray-400 text-sm md:text-base">
                    {{ t('userDeletionUpdated') }}
                </p>
            </div>
        </section>

        <section class="py-16 px-4 bg-gray-50">
            <div class="max-w-4xl mx-auto space-y-8">
                <article class="bg-white rounded-2xl border border-gray-200 shadow-sm p-8 md:p-10 space-y-4">
                    <p class="text-gray-600 leading-relaxed">
                        {{ t('userDeletionIntro') }}
                    </p>
                </article>

                <article class="bg-white rounded-2xl border border-gray-200 shadow-sm p-8 md:p-10 space-y-4">
                    <h2 class="text-xl font-bold text-gray-900">{{ t('userDeletionHowTitle') }}</h2>
                    <ul class="list-disc ps-5 space-y-2 text-gray-600 leading-relaxed">
                        <li>{{ t('userDeletionHow1') }}</li>
                        <li>{{ t('userDeletionHow2') }}</li>
                        <li>{{ t('userDeletionHow3') }}</li>
                    </ul>
                </article>

                <article class="bg-white rounded-2xl border border-gray-200 shadow-sm p-8 md:p-10 space-y-4">
                    <h2 class="text-xl font-bold text-gray-900">{{ t('userDeletionProcessTitle') }}</h2>
                    <ul class="list-disc ps-5 space-y-2 text-gray-600 leading-relaxed">
                        <li>{{ t('userDeletionProcess1') }}</li>
                        <li>{{ t('userDeletionProcess2') }}</li>
                        <li>{{ t('userDeletionProcess3') }}</li>
                    </ul>
                </article>

                <article class="bg-white rounded-2xl border border-gray-200 shadow-sm p-8 md:p-10 space-y-4">
                    <h2 class="text-xl font-bold text-gray-900">{{ t('userDeletionExceptionsTitle') }}</h2>
                    <p class="text-gray-600 leading-relaxed">
                        {{ t('userDeletionExceptionsText') }}
                    </p>
                </article>

                <article class="bg-white rounded-2xl border border-gray-200 shadow-sm p-8 md:p-10 space-y-4">
                    <h2 class="text-xl font-bold text-gray-900">{{ t('userDeletionCallbackTitle') }}</h2>
                    <p class="text-gray-600 leading-relaxed">
                        {{ t('userDeletionCallbackText') }}
                    </p>
                </article>

                <article class="bg-white rounded-2xl border border-gray-200 shadow-sm p-8 md:p-10 space-y-4">
                    <h2 class="text-xl font-bold text-gray-900">{{ t('userDeletionContactTitle') }}</h2>
                    <p class="text-gray-600 leading-relaxed">
                        {{ t('userDeletionContactText') }}
                    </p>
                    <div class="pt-2 flex flex-wrap items-center gap-4 text-sm">
                        <a href="mailto:info@itap-tech.com" class="text-blue-600 hover:text-blue-800 font-medium transition-colors">
                            info@itap-tech.com
                        </a>
                        <Link href="/contact-us" class="text-blue-600 hover:text-blue-800 font-medium transition-colors">
                            {{ t('navContact') }} ->
                        </Link>
                    </div>
                </article>
            </div>
        </section>

        <footer class="bg-gray-900 text-white">
            <div class="max-w-7xl mx-auto px-4 py-10">
                <div class="flex flex-col items-center justify-center gap-4 text-sm">
                    <Link href="/" class="text-gray-400 hover:text-white transition-colors">
                        {{ t('navHome') }}
                    </Link>
                    <div class="text-gray-500">
                        {{ t('footerCopyright') }}
                    </div>
                </div>
            </div>
        </footer>
    </div>
</template>

<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3'
import { watch } from 'vue'
import NavBar from '@/components/NavBar.vue'
import { useLanguage } from '@/composables/useLanguage'

const { currentLanguage, t } = useLanguage()

watch(
    currentLanguage,
    (newLang) => {
        if (newLang === 'ar') {
            document.documentElement.setAttribute('dir', 'rtl')
            document.documentElement.setAttribute('lang', 'ar')
        } else {
            document.documentElement.setAttribute('dir', 'ltr')
            document.documentElement.setAttribute('lang', 'en')
        }
    },
    { immediate: true },
)
</script>
