<template>
    <nav class="fixed top-0 left-0 right-0 z-50 border-b border-black/[0.06] bg-white/95 backdrop-blur-sm">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div dir="ltr" class="flex h-16 items-center justify-between">
                <Link href="/" class="flex items-center gap-3" @click="closeMobileMenu">
                    <img :src="effectiveLogoSrc" alt="iTab Logo" class="h-10 w-auto shrink-0" />
                    <span class="text-xl font-bold text-gray-900">iTab</span>
                </Link>

                <div class="hidden items-center gap-2 md:flex lg:gap-4">
                    <div dir="rtl" class="flex items-center gap-2 lg:gap-4">
                        <button
                            v-for="item in navItems"
                            :key="item.label"
                            type="button"
                            class="rounded-lg px-3 py-2 text-sm font-medium text-gray-700 transition-colors hover:text-blue-600"
                            @click="navigateTo(item)"
                        >
                            {{ item.label }}
                        </button>
                    </div>

                    <div class="relative ms-2">
                        <button
                            type="button"
                            class="flex h-10 w-10 items-center justify-center rounded-lg border border-gray-200 bg-white text-gray-700 transition-colors hover:bg-gray-100"
                            @click="toggleLanguageMenu"
                        >
                            <Globe class="h-5 w-5" />
                        </button>

                        <div
                            v-if="isLanguageMenuOpen"
                            class="absolute left-1/2 top-full z-10 mt-2 w-52 -translate-x-1/2 overflow-hidden rounded-xl border border-gray-200 bg-white py-1 shadow-xl"
                        >
                            <button
                                type="button"
                                class="flex w-full items-center gap-3 px-4 py-3 text-right text-sm text-gray-700 transition-colors hover:bg-gray-50"
                                @click="changeLanguage('ar')"
                            >
                                <span class="text-xl">🇸🇦</span>
                                <span class="flex-1 text-right">العربية</span>
                                <span v-if="currentLanguage === 'ar'" class="text-xs text-gray-400">مفعلة</span>
                            </button>
                            <button
                                type="button"
                                class="flex w-full items-center gap-3 px-4 py-3 text-right text-sm text-gray-700 transition-colors hover:bg-gray-50"
                                @click="changeLanguage('en')"
                            >
                                <span class="text-xl">🇬🇧</span>
                                <span class="flex-1 text-right">English</span>
                                <span v-if="currentLanguage === 'en'" class="text-xs text-gray-400">Active</span>
                            </button>
                        </div>
                    </div>
                </div>

                <button
                    type="button"
                    class="rounded-lg p-2 text-gray-900 transition-colors hover:bg-gray-100 md:hidden"
                    @click="toggleMobileMenu"
                >
                    <X v-if="isMobileMenuOpen" :size="24" />
                    <Menu v-else :size="24" />
                </button>
            </div>

            <div v-if="isMobileMenuOpen" class="border-t border-black/[0.06] py-4 md:hidden">
                <div class="space-y-2">
                    <button
                        v-for="item in navItems"
                        :key="item.label"
                        type="button"
                        class="block w-full rounded-lg px-4 py-2 text-right text-base text-gray-700 transition-colors hover:bg-gray-100"
                        @click="navigateTo(item)"
                    >
                        {{ item.label }}
                    </button>

                    <div class="space-y-2 px-1 pt-2">
                        <button
                            type="button"
                            class="flex w-full items-center gap-3 rounded-lg px-3 py-2 text-sm font-medium transition-colors"
                            :class="currentLanguage === 'ar' ? 'bg-gray-900 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200'"
                            @click="changeLanguage('ar')"
                        >
                            <span class="text-lg">🇸🇦</span>
                            <span>العربية</span>
                        </button>
                        <button
                            type="button"
                            class="flex w-full items-center gap-3 rounded-lg px-3 py-2 text-sm font-medium transition-colors"
                            :class="currentLanguage === 'en' ? 'bg-gray-900 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200'"
                            @click="changeLanguage('en')"
                        >
                            <span class="text-lg">🇬🇧</span>
                            <span>English</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </nav>
</template>

<script setup lang="ts">
import { Link } from '@inertiajs/vue3'
import { Globe, Menu, X } from 'lucide-vue-next'
import { computed, ref } from 'vue'
import { useLanguage } from '@/composables/useLanguage'

interface Props {
    logoSrc?: string
    textColor?: string
    backgroundColor?: string
    theme?: 'light' | 'dark'
}

interface NavItem {
    label: string
    sectionId?: string
    href?: string
}

const props = withDefaults(defineProps<Props>(), {
    logoSrc: undefined,
    textColor: 'white',
    backgroundColor: 'transparent',
    theme: 'dark',
})

const isMobileMenuOpen = ref(false)
const isLanguageMenuOpen = ref(false)
const { currentLanguage, setLanguage } = useLanguage()

const defaultLogo = '/asset/Black_White_Minimal_Modern_Simple_Bold_Business_Mag_Logo__1_-removebg-preview.png'

const effectiveLogoSrc = computed(() => props.logoSrc ?? defaultLogo)

const navItems: NavItem[] = [
    { label: 'الرئيسية', sectionId: 'hero' },
    { label: 'الخدمات', sectionId: 'services' },
    { label: 'القطاعات', sectionId: 'industries' },
    { label: 'الأعمال', sectionId: 'portfolio' },
    { label: 'تواصل معنا', sectionId: 'contact' },
]

const closeMobileMenu = () => {
    isMobileMenuOpen.value = false
}

const scrollToSection = (id: string) => {
    const element = document.getElementById(id)

    if (!element) {
        return
    }

    const top = element.getBoundingClientRect().top + window.scrollY - 88
    window.scrollTo({ top, behavior: 'smooth' })
    closeMobileMenu()
}

const navigateTo = (item: NavItem) => {
    if (typeof window === 'undefined') {
        return
    }

    if (item.sectionId) {
        if (window.location.pathname === '/') {
            scrollToSection(item.sectionId)
            return
        }

        window.location.href = `/#${item.sectionId}`
        isLanguageMenuOpen.value = false
        closeMobileMenu()
        return
    }

    if (item.href) {
        window.location.href = item.href
        isLanguageMenuOpen.value = false
        closeMobileMenu()
    }
}

const changeLanguage = (lang: 'ar' | 'en') => {
    setLanguage(lang)
    isLanguageMenuOpen.value = false
    closeMobileMenu()
}

const toggleLanguageMenu = () => {
    isLanguageMenuOpen.value = !isLanguageMenuOpen.value
}

const toggleMobileMenu = () => {
    isMobileMenuOpen.value = !isMobileMenuOpen.value
}
</script>
