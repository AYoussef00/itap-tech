<template>
    <nav
        :class="[
            'left-0 right-0 z-50',
            isLightTheme ? 'fixed top-0 border-b border-black/[0.06] bg-white/80 shadow-[0_1px_0_rgba(0,0,0,0.04)] backdrop-blur-xl supports-[backdrop-filter]:bg-white/70' : 'absolute top-8',
            !isLightTheme ? backgroundColorClass : '',
        ]"
    >
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Physical layout: logo left, navigation right (consistent in RTL/LTR) -->
            <div dir="ltr" class="flex items-center justify-between h-14 md:h-16">
                <!-- Logo (left) -->
                <div class="flex shrink-0 items-center">
                    <Link href="/" class="flex items-center py-1">
                        <img :src="effectiveLogoSrc" alt="iTab Logo" class="h-8 w-auto md:h-9" />
                    </Link>
                </div>

                <!-- Desktop nav (right) -->
                <div class="hidden md:flex items-center gap-0.5">
                    <Link
                        href="/"
                        :class="navLinkClass"
                    >
                        الرئيسية
                    </Link>

                    <div class="relative" @mouseenter="isServicesDropdownOpen = true" @mouseleave="isServicesDropdownOpen = false">
                        <button type="button" :class="navButtonClass">
                            الخدمات
                            <ChevronDown class="w-4 h-4 opacity-60 transition-transform duration-200" :class="isServicesDropdownOpen ? 'rotate-180' : ''" />
                        </button>

                        <div
                            v-show="isServicesDropdownOpen"
                            class="absolute end-0 top-full mt-2 w-80 overflow-hidden rounded-2xl border border-black/[0.06] bg-white shadow-[0_12px_40px_rgba(0,0,0,0.08)]"
                        >
                            <div class="border-b border-gray-100 px-5 py-4">
                                <h3 class="text-[15px] font-semibold tracking-tight text-gray-900">خدماتنا</h3>
                                <p class="mt-0.5 text-[13px] text-gray-500">حلول احترافية لعملك</p>
                            </div>
                            <div class="py-2">
                                <Link
                                    v-for="service in services"
                                    :key="service.name"
                                    :href="service.href"
                                    class="group flex items-center px-5 py-2.5 text-[13px] text-gray-700 transition-colors hover:bg-gray-50"
                                >
                                    <span class="flex-1 font-medium">{{ service.name }}</span>
                                    <svg class="h-4 w-4 text-gray-400 opacity-0 transition-opacity group-hover:opacity-100" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                    </svg>
                                </Link>
                            </div>
                            <div class="border-t border-gray-100 bg-gray-50/80 px-5 py-3">
                                <Link href="/contact-us" class="text-[13px] font-medium text-gray-900 hover:underline">
                                    احصل على استشارة مجانية
                                </Link>
                            </div>
                        </div>
                    </div>

                    <Link href="/about-us" :class="navLinkClass">من نحن</Link>
                    <Link href="/contact-us" :class="navLinkClass">اتصل بنا</Link>

                    <div class="relative ms-1" @mouseenter="isLanguageDropdownOpen = true" @mouseleave="isLanguageDropdownOpen = false">
                        <button type="button" :class="navButtonClass">
                            <Globe class="h-4 w-4 opacity-70" />
                            <span class="hidden lg:inline">{{ currentLanguage === 'ar' ? 'العربية' : 'English' }}</span>
                        </button>
                        <div
                            v-show="isLanguageDropdownOpen"
                            class="absolute end-0 top-full mt-2 w-48 overflow-hidden rounded-xl border border-black/[0.06] bg-white py-1 shadow-[0_12px_40px_rgba(0,0,0,0.08)]"
                        >
                            <button
                                type="button"
                                class="flex w-full items-center gap-2 px-4 py-2.5 text-start text-sm text-gray-700 transition-colors hover:bg-gray-50"
                                @click="changeLanguage('en')"
                            >
                                <span>🇺🇸</span>
                                <span>English</span>
                                <span v-if="currentLanguage === 'en'" class="ms-auto text-gray-900">✓</span>
                            </button>
                            <button
                                type="button"
                                class="flex w-full items-center gap-2 px-4 py-2.5 text-start text-sm text-gray-700 transition-colors hover:bg-gray-50"
                                @click="changeLanguage('ar')"
                            >
                                <span>🇪🇬</span>
                                <span>العربية</span>
                                <span v-if="currentLanguage === 'ar'" class="ms-auto text-gray-900">✓</span>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Mobile menu toggle -->
                <div class="md:hidden">
                    <button type="button" :class="mobileToggleClass" @click="toggleMobileMenu">
                        <svg v-if="!isMobileMenuOpen" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                        <svg v-else class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile nav -->
        <div v-show="isMobileMenuOpen" class="md:hidden border-t border-black/[0.06] bg-white/95 backdrop-blur-md">
            <div class="max-w-7xl mx-auto space-y-1 px-4 py-4">
                <Link href="/" class="block rounded-xl px-3 py-2.5 text-base font-medium text-gray-900 hover:bg-gray-100" @click="isMobileMenuOpen = false">
                    الرئيسية
                </Link>
                <div class="rounded-xl border border-gray-100 bg-gray-50/80 p-3">
                    <div class="mb-2 px-1 text-sm font-semibold text-gray-900">خدماتنا</div>
                    <div class="space-y-0.5">
                        <Link
                            v-for="service in services"
                            :key="service.name"
                            :href="service.href"
                            class="block rounded-lg px-3 py-2 text-sm text-gray-700 hover:bg-white"
                            @click="isMobileMenuOpen = false"
                        >
                            {{ service.name }}
                        </Link>
                    </div>
                    <Link href="/contact-us" class="mt-2 block px-3 text-sm font-medium text-gray-900 hover:underline" @click="isMobileMenuOpen = false">
                        احصل على استشارة مجانية
                    </Link>
                </div>
                <Link href="/about-us" class="block rounded-xl px-3 py-2.5 text-base font-medium text-gray-900 hover:bg-gray-100" @click="isMobileMenuOpen = false">
                    من نحن
                </Link>
                <Link href="/contact-us" class="block rounded-xl px-3 py-2.5 text-base font-medium text-gray-900 hover:bg-gray-100" @click="isMobileMenuOpen = false">
                    اتصل بنا
                </Link>
                <div class="border-t border-gray-100 pt-3">
                    <div class="mb-2 px-1 text-xs font-medium uppercase tracking-wide text-gray-500">اللغة</div>
                    <div class="flex gap-2">
                        <button
                            type="button"
                            class="flex-1 rounded-xl px-3 py-2.5 text-sm font-medium transition-colors"
                            :class="currentLanguage === 'en' ? 'bg-gray-900 text-white' : 'bg-gray-100 text-gray-800 hover:bg-gray-200'"
                            @click="changeLanguage('en')"
                        >
                            English
                        </button>
                        <button
                            type="button"
                            class="flex-1 rounded-xl px-3 py-2.5 text-sm font-medium transition-colors"
                            :class="currentLanguage === 'ar' ? 'bg-gray-900 text-white' : 'bg-gray-100 text-gray-800 hover:bg-gray-200'"
                            @click="changeLanguage('ar')"
                        >
                            العربية
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </nav>
</template>

<script setup lang="ts">
import { Link } from '@inertiajs/vue3'
import { ref, computed } from 'vue'
import { ChevronDown, Globe } from 'lucide-vue-next'
import { useLanguage } from '@/composables/useLanguage'

interface Props {
    logoSrc?: string
    textColor?: string
    backgroundColor?: string
    /** Light: white bar + dark logo (Apple-style). Dark: transparent + white text (legacy pages). */
    theme?: 'light' | 'dark'
}

const props = withDefaults(defineProps<Props>(), {
    logoSrc: undefined,
    textColor: 'white',
    backgroundColor: 'transparent',
    theme: 'dark',
})

const isMobileMenuOpen = ref(false)
const isServicesDropdownOpen = ref(false)
const isLanguageDropdownOpen = ref(false)

const { currentLanguage, setLanguage } = useLanguage()

const isLightTheme = computed(() => props.theme === 'light')

const defaultLogoDark = '/asset/logo-new-white.png'
const defaultLogoLight = '/asset/Black_White_Minimal_Modern_Simple_Bold_Business_Mag_Logo__1_-removebg-preview.png'

const effectiveLogoSrc = computed(() => {
    if (props.logoSrc) {
        return props.logoSrc
    }
    return isLightTheme.value ? defaultLogoLight : defaultLogoDark
})

const changeLanguage = (lang: 'ar' | 'en') => {
    setLanguage(lang)
    isLanguageDropdownOpen.value = false
}

const toggleMobileMenu = () => {
    isMobileMenuOpen.value = !isMobileMenuOpen.value
}

const navLinkClass = computed(() =>
    isLightTheme.value
        ? 'rounded-full px-3.5 py-2 text-[13px] font-medium text-gray-800 transition-colors hover:bg-black/[0.04]'
        : `${textColorClass.value} hover:text-gray-300 px-3 py-2 rounded-lg text-sm font-medium transition-colors duration-200 hover:bg-white/10`,
)

const navButtonClass = computed(() =>
    isLightTheme.value
        ? 'inline-flex items-center gap-1.5 rounded-full px-3.5 py-2 text-[13px] font-medium text-gray-800 transition-colors hover:bg-black/[0.04]'
        : `${textColorClass.value} hover:text-gray-300 px-3 py-2 rounded-lg text-sm font-medium transition-colors duration-200 hover:bg-white/10 flex items-center gap-1`,
)

const mobileToggleClass = computed(() =>
    isLightTheme.value ? 'rounded-lg p-2 text-gray-900 hover:bg-gray-100' : `${textColorClass.value} hover:text-gray-300 focus:outline-none focus:text-gray-300 p-2`,
)

const textColorClass = computed(() => {
    return props.textColor === 'black' ? 'text-gray-900' : 'text-white'
})

const backgroundColorClass = computed(() => {
    return props.backgroundColor === 'black' ? 'bg-black' : 'bg-transparent'
})
const services = [
    { name: 'تطوير المواقع', href: '/services/web-development' },
    { name: 'تطوير التطبيقات', href: '/services/mobile-development' },
    { name: 'الحلول البرمجية', href: '/services/software-solutions' },
    { name: 'المساعد الافتراضي والأتمتة', href: '/services/chatbot-automation' },
    { name: 'الحضور الرقمي والتسويق', href: '/services/digital-marketing' },
    { name: 'خدمات السحابة والـ DevOps', href: '/services/cloud-devops' },
    { name: 'الاستشارات والدعم الفني', href: '/services/consulting' },
]
</script>
