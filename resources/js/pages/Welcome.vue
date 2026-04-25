<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3'
import { ref, computed, onMounted, onUnmounted, watch } from 'vue'
import NavBar from '@/components/NavBar.vue'
import { useLanguage } from '@/composables/useLanguage'
import { Button } from '@/components/ui/button'
import { Card } from '@/components/ui/card'
// import ChatBot from '@/components/ChatBot.vue' // Temporarily hidden

// Language support
const { currentLanguage, setLanguage, t, isRTL } = useLanguage()

// Watch language changes and update HTML dir attribute
watch(currentLanguage, (newLang) => {
    if (newLang === 'ar') {
        document.documentElement.setAttribute('dir', 'rtl')
        document.documentElement.setAttribute('lang', 'ar')
    } else {
        document.documentElement.setAttribute('dir', 'ltr')
        document.documentElement.setAttribute('lang', 'en')
    }
}, { immediate: true })

// ChatBot is automatically registered in Vue 3 Composition API
import {
    Award,
    ArrowLeft,
    ArrowRight,
    BadgeCheck,
    BarChart3,
    Bot,
    Brain,
    Briefcase,
    Building,
    Building2,
    CheckCircle,
    Clock,
    Code,
    Cpu,
    CreditCard,
    DollarSign,
    Facebook,
    Factory,
    FileCheck,
    FileLock,
    FileText,
    Globe,
    GraduationCap,
    Headphones,
    Heart,
    Hotel,
    Instagram,
    Linkedin,
    Lock,
    Mail,
    MapPin,
    MessageCircle,
    MessageSquare,
    Monitor,
    Network,
    Package,
    Phone,
    Quote,
    Rocket,
    Search,
    Send,
    Settings,
    Shield,
    ShoppingBag,
    ShoppingCart,
    Smartphone,
    Sparkles,
    Star,
    Target,
    TrendingUp,
    Truck,
    Twitter,
    Users,
    UtensilsCrossed,
    Wrench,
    Zap,
} from 'lucide-vue-next'

// Services data
const services = [
    {
        icon: Globe,
        title: 'تطوير المواقع الإلكترونية',
        description: 'مواقع احترافية متجاوبة وسريعة مع تجربة مستخدم استثنائية',
        color: 'from-blue-500 to-blue-600',
        href: '/services/web-development',
    },
    {
        icon: Smartphone,
        title: 'تطبيقات الموبايل',
        description: 'تطبيقات iOS و Android عالية الأداء وسهلة الاستخدام',
        color: 'from-violet-500 to-violet-600',
        href: '/services/mobile-development',
    },
    {
        icon: Settings,
        title: 'تهيئة الأنظمة',
        description: 'تحسين وتهيئة الأنظمة لأداء أفضل وأمان أعلى',
        color: 'from-cyan-500 to-cyan-600',
        href: '/services/cloud-devops',
    },
    {
        icon: Bot,
        title: 'الشات بوت والذكاء الاصطناعي',
        description: 'روبوتات محادثة ذكية تعمل بالذكاء الاصطناعي المتقدم',
        color: 'from-pink-500 to-pink-600',
        href: '/services/chatbot-automation',
    },
    {
        icon: Building2,
        title: 'أنظمة الشركات ERP/CRM',
        description: 'حلول متكاملة لإدارة موارد الشركات والعلاقات مع العملاء',
        color: 'from-orange-500 to-orange-600',
        href: '/services/software-solutions',
    },
    {
        icon: BarChart3,
        title: 'تحليل البيانات',
        description: 'تحويل البيانات إلى رؤى قيّمة لاتخاذ قرارات أفضل',
        color: 'from-green-500 to-green-600',
        href: '/services/digital-marketing',
    },
    {
        icon: Brain,
        title: 'حلول الذكاء الاصطناعي',
        description: 'أنظمة ذكية متقدمة لأتمتة العمليات وتحسين الإنتاجية',
        color: 'from-indigo-500 to-indigo-600',
        href: '/services/consulting',
    },
]

const aiFeatures = [
    {
        icon: Brain,
        title: 'الذكاء الاصطناعي المتقدم',
        description: 'تطبيق خوارزميات التعلم الآلي والتعلم العميق لحل المشكلات المعقدة',
    },
    {
        icon: Cpu,
        title: 'معالجة اللغات الطبيعية',
        description: 'فهم وتحليل النصوص العربية والإنجليزية بدقة عالية',
    },
    {
        icon: Network,
        title: 'التعلم الآلي',
        description: 'بناء نماذج تنبؤية ذكية تتحسن مع الوقت والاستخدام',
    },
    {
        icon: Sparkles,
        title: 'الأتمتة الذكية',
        description: 'أتمتة العمليات التشغيلية لتوفير الوقت والجهد',
    },
]

const industries = [
    {
        icon: GraduationCap,
        title: 'المدارس والتعليم',
        description: 'أنظمة إدارة تعليمية متطورة ومنصات تعلم إلكتروني',
        gradient: 'from-blue-500/10 to-blue-600/10',
        iconColor: 'text-blue-600',
    },
    {
        icon: Building,
        title: 'الشركات والمؤسسات',
        description: 'حلول متكاملة لإدارة العمليات وتحسين الإنتاجية',
        gradient: 'from-violet-500/10 to-violet-600/10',
        iconColor: 'text-violet-600',
    },
    {
        icon: Hotel,
        title: 'الفنادق والضيافة',
        description: 'أنظمة حجز وإدارة فندقية ذكية ومتكاملة',
        gradient: 'from-pink-500/10 to-pink-600/10',
        iconColor: 'text-pink-600',
    },
    {
        icon: Factory,
        title: 'المصانع والإنتاج',
        description: 'حلول أتمتة وتتبع الإنتاج وإدارة المخزون',
        gradient: 'from-orange-500/10 to-orange-600/10',
        iconColor: 'text-orange-600',
    },
    {
        icon: ShoppingBag,
        title: 'التجزئة والمحلات',
        description: 'أنظمة نقاط بيع ومتاجر إلكترونية احترافية',
        gradient: 'from-green-500/10 to-green-600/10',
        iconColor: 'text-green-600',
    },
    {
        icon: Briefcase,
        title: 'الأعمال الحرة',
        description: 'منصات وأدوات لإدارة المشاريع والعملاء',
        gradient: 'from-cyan-500/10 to-cyan-600/10',
        iconColor: 'text-cyan-600',
    },
]

const advantages = [
    {
        icon: Shield,
        title: 'أمان عالي المستوى',
        description: 'نحمي بياناتك وأنظمتك بأحدث معايير الأمان السيبراني وبروتوكولات الحماية المتقدمة',
        features: ['تشفير متقدم', 'نسخ احتياطي دوري', 'حماية من الاختراق'],
        gradient: 'from-blue-500 to-blue-600',
    },
    {
        icon: Zap,
        title: 'سرعة في التنفيذ',
        description: 'فريق محترف يعمل بكفاءة عالية لتسليم مشاريعك في الوقت المحدد بجودة استثنائية',
        features: ['تسليم سريع', 'منهجية Agile', 'فريق متفرغ'],
        gradient: 'from-orange-500 to-orange-600',
    },
    {
        icon: DollarSign,
        title: 'تكلفة تنافسية',
        description: 'أسعار منافسة تناسب جميع الميزانيات مع الحفاظ على أعلى معايير الجودة والاحترافية',
        features: ['أسعار عادلة', 'لا رسوم خفية', 'خطط مرنة'],
        gradient: 'from-green-500 to-green-600',
    },
]

const portfolioProjects = [
    {
        title: 'نظام إدارة مدرسية متكامل',
        category: 'تعليم',
        description: 'منصة شاملة لإدارة العمليات التعليمية والإدارية للمدارس',
        image: 'https://images.unsplash.com/photo-1509062522246-3755977927d7?w=800&q=80',
        tags: ['React', 'Node.js', 'MongoDB'],
    },
    {
        title: 'منصة تجارة إلكترونية',
        category: 'تجارة',
        description: 'متجر إلكتروني متعدد البائعين مع نظام دفع آمن',
        image: 'https://images.unsplash.com/photo-1460925895917-afdab827c52f?w=800&q=80',
        tags: ['Next.js', 'Stripe', 'PostgreSQL'],
    },
    {
        title: 'تطبيق حجز فندقي',
        category: 'ضيافة',
        description: 'تطبيق موبايل لحجز الغرف وإدارة الخدمات الفندقية',
        image: 'https://images.unsplash.com/photo-1551434678-e076c223a692?w=800&q=80',
        tags: ['React Native', 'Firebase', 'Maps API'],
    },
    {
        title: 'نظام ERP للمصانع',
        category: 'صناعة',
        description: 'حل متكامل لإدارة الإنتاج والمخزون والمشتريات',
        image: 'https://images.unsplash.com/photo-1504868584819-f8e8b4b6d7e3?w=800&q=80',
        tags: ['Vue.js', 'Laravel', 'MySQL'],
    },
    {
        title: 'شات بوت ذكي للدعم الفني',
        category: 'ذكاء اصطناعي',
        description: 'روبوت محادثة يعمل بالذكاء الاصطناعي لخدمة العملاء',
        image: 'https://images.unsplash.com/photo-1531746790731-6c087fecd65a?w=800&q=80',
        tags: ['Python', 'TensorFlow', 'NLP'],
    },
    {
        title: 'لوحة تحليل البيانات',
        category: 'تحليلات',
        description: 'نظام تحليل متقدم مع تقارير وإحصائيات تفاعلية',
        image: 'https://images.unsplash.com/photo-1551288049-bebda4e38f71?w=800&q=80',
        tags: ['React', 'D3.js', 'Python'],
    },
]

// Goals data
const goals = [
    {
        icon: Users,
        number: '500+',
        label: 'عميل راضٍ',
    },
    {
        icon: Sparkles,
        number: '1000+',
        label: 'مشروع منجز',
    },
    {
        icon: TrendingUp,
        number: '98%',
        label: 'نسبة النجاح',
    },
    {
        icon: Target,
        number: '24/7',
        label: 'دعم فني',
    },
]

// About Us Features data
const aboutFeatures = [
    {
        icon: Code,
        title: 'تصميم عصري',
        description: 'واجهات مستخدم جذابة وعصرية',
    },
    {
        icon: Shield,
        title: 'حماية من الاختراق',
        description: 'أمان عالي المستوى لحماية بياناتك',
    },
    {
        icon: CheckCircle,
        title: 'ميزات متكاملة',
        description: 'حلول شاملة لجميع احتياجاتك',
    },
    {
        icon: Wrench,
        title: 'صيانة للثغرات مجانًا',
        description: 'دعم فني ومتابعة مستمرة',
    },
    {
        icon: Code,
        title: 'إنشاء لوحة تحكم لك',
        description: 'إدارة كاملة لموقعك أو تطبيقك',
    },
    {
        icon: Clock,
        title: '24/7 دعم',
        description: 'فريق دعم متاح على مدار الساعة',
    },
]

interface CompanyLogo {
    id: number;
    logo_url: string;
    original_name: string | null;
}

interface Props {
    companyLogos?: CompanyLogo[];
}

const props = defineProps<Props>();

// Partners data - use company logos from database if available, otherwise use empty array
const partners = computed(() => {
    if (props.companyLogos && props.companyLogos.length > 0) {
        return props.companyLogos.map(logo => ({
            name: logo.original_name || 'Partner',
            logo: logo.logo_url,
            website: '#'
        }));
    }
    return [];
});

const scrollToSection = (id: string) => {
    const element = document.getElementById(id)

    if (!element) {
        return
    }

    const top = element.getBoundingClientRect().top + window.scrollY - 88
    window.scrollTo({ top, behavior: 'smooth' })
}

const currentYear = new Date().getFullYear()

const contactForm = ref({
    name: '',
    email: '',
    phone: '',
    company: '',
    message: '',
})

const resetContactForm = () => {
    contactForm.value = {
        name: '',
        email: '',
        phone: '',
        company: '',
        message: '',
    }
}

const handleContactSubmit = () => {
    console.log('Form submitted:', contactForm.value)
    window.alert('شكراً لتواصلك معنا! سنرد عليك في أقرب وقت ممكن.')
    resetContactForm()
}
</script>

<template>
    <Head title="iTab - Leading Software Development Company" />

    <!-- Navigation: logo left, links right (handled inside NavBar via dir="ltr") -->
    <NavBar theme="light" />

    <div class="min-h-screen bg-[#ffffff]">
        <section id="hero" class="relative flex min-h-screen items-center justify-center overflow-hidden bg-gradient-to-br from-white via-blue-50 to-blue-100">
            <div class="absolute inset-0 overflow-hidden">
                <div class="absolute right-1/4 top-1/4 h-72 w-72 rounded-full bg-blue-200/30 blur-3xl md:h-96 md:w-96"></div>
                <div class="absolute bottom-1/4 left-1/4 h-72 w-72 rounded-full bg-violet-200/20 blur-3xl md:h-96 md:w-96"></div>
            </div>

            <div class="relative mx-auto max-w-7xl px-4 py-24 text-center sm:px-6 md:py-28 lg:px-8 lg:py-32">
                <div class="mb-6 inline-flex max-w-full items-center gap-2 rounded-full bg-blue-100 px-4 py-2 text-blue-700">
                    <Sparkles class="h-4 w-4" />
                    <span class="text-xs sm:text-sm">حلول تقنية متقدمة للمستقبل الرقمي</span>
                </div>

                <h1 class="mb-6 text-4xl font-bold leading-tight text-gray-900 sm:text-5xl md:text-6xl lg:text-7xl">
                    نحو مستقبل رقمي
                    <br />
                    <span class="bg-gradient-to-r from-blue-600 to-violet-600 bg-clip-text text-transparent">
                        أكثر ذكاءً
                    </span>
                </h1>

                <p class="mx-auto mb-10 max-w-3xl text-base leading-8 text-gray-600 sm:text-lg md:text-xl">
                    نقدم حلولاً تقنية متكاملة تشمل تطوير المواقع والتطبيقات، أنظمة الذكاء الاصطناعي، وحلول الأعمال المتقدمة للشركات والمؤسسات في السعودية ومصر
                </p>

                <div class="flex flex-col items-center justify-center gap-4 sm:flex-row">
                    <Link
                        href="/contact-us"
                        class="group inline-flex w-full items-center justify-center gap-2 rounded-xl bg-gradient-to-r from-blue-600 to-violet-600 px-8 py-4 text-white transition-all hover:shadow-2xl sm:w-auto"
                    >
                        <span>ابدأ مشروعك الآن</span>
                        <ArrowLeft class="h-5 w-5 transition-transform group-hover:-translate-x-1" />
                    </Link>

                    <button
                        type="button"
                        class="w-full rounded-xl border-2 border-gray-200 bg-white px-8 py-4 text-gray-900 transition-all hover:border-blue-600 hover:shadow-lg sm:w-auto"
                        @click="scrollToSection('services')"
                    >
                        استكشف خدماتنا
                    </button>
                </div>

                <div class="mx-auto mt-16 grid max-w-4xl grid-cols-2 gap-6 md:mt-20 md:gap-8 md:grid-cols-4">
                    <div class="text-center">
                        <div class="mb-2 text-3xl font-bold text-blue-600 md:text-4xl">+500</div>
                        <div class="text-sm text-gray-600">مشروع مكتمل</div>
                    </div>
                    <div class="text-center">
                        <div class="mb-2 text-3xl font-bold text-blue-600 md:text-4xl">+200</div>
                        <div class="text-sm text-gray-600">عميل راضٍ</div>
                    </div>
                    <div class="text-center">
                        <div class="mb-2 text-3xl font-bold text-blue-600 md:text-4xl">99%</div>
                        <div class="text-sm text-gray-600">معدل الرضا</div>
                    </div>
                    <div class="text-center">
                        <div class="mb-2 text-3xl font-bold text-blue-600 md:text-4xl">24/7</div>
                        <div class="text-sm text-gray-600">دعم فني</div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Our Services -->
        <section id="services" class="bg-white py-16 md:py-24">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <div class="mb-12 text-center md:mb-16">
                    <h2 class="mb-4 text-3xl font-bold text-gray-900 sm:text-4xl md:text-5xl">
                        خدماتنا التقنية
                    </h2>
                    <p class="mx-auto max-w-2xl text-base leading-7 text-gray-600 sm:text-lg md:text-xl">
                        نقدم مجموعة شاملة من الحلول التقنية المتطورة لتلبية جميع احتياجات عملك الرقمي
                    </p>
                </div>

                <div class="grid grid-cols-1 gap-8 md:grid-cols-2 lg:grid-cols-3">
                    <div
                        v-for="service in services"
                        :key="service.title"
                        class="group rounded-2xl border border-gray-200 bg-white p-6 transition-all duration-300 hover:border-blue-200 hover:shadow-2xl md:p-8"
                    >
                        <div
                            class="mb-6 flex h-16 w-16 items-center justify-center rounded-xl bg-gradient-to-br transition-transform group-hover:scale-110"
                            :class="service.color"
                        >
                            <component :is="service.icon" class="h-8 w-8 text-white" />
                        </div>
                        <h3 class="mb-3 text-xl font-bold text-gray-900 md:text-2xl">
                            {{ service.title }}
                        </h3>
                        <p class="mb-4 leading-relaxed text-gray-600">
                            {{ service.description }}
                        </p>
                        <Link
                            :href="service.href"
                            class="flex items-center gap-1 text-blue-600 transition-all group-hover:text-blue-700 hover:gap-2"
                        >
                            <span>اعرف المزيد</span>
                            <ArrowLeft class="h-4 w-4" />
                        </Link>
                    </div>
                </div>
            </div>
        </section>

        <section id="industries" class="bg-gradient-to-b from-gray-50 to-white py-16 md:py-24">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <div class="mb-12 text-center md:mb-16">
                    <h2 class="mb-4 text-3xl font-bold text-gray-900 sm:text-4xl md:text-5xl">
                        القطاعات التي نخدمها
                    </h2>
                    <p class="mx-auto max-w-2xl text-base leading-7 text-gray-600 sm:text-lg md:text-xl">
                        خبرة واسعة في خدمة مختلف القطاعات بحلول تقنية مخصصة لكل مجال
                    </p>
                </div>

                <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3">
                    <div
                        v-for="industry in industries"
                        :key="industry.title"
                        class="group cursor-pointer rounded-2xl border border-gray-200 bg-gradient-to-br p-6 backdrop-blur-sm transition-all duration-300 hover:shadow-xl md:p-8"
                        :class="industry.gradient"
                    >
                        <div class="flex items-start gap-4">
                            <div :class="[industry.iconColor, 'transition-transform group-hover:scale-110']">
                                <component :is="industry.icon" class="h-10 w-10" :stroke-width="1.5" />
                            </div>
                            <div class="flex-1">
                                <h3 class="mb-2 text-xl font-bold text-gray-900">
                                    {{ industry.title }}
                                </h3>
                                <p class="leading-relaxed text-gray-600">
                                    {{ industry.description }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="bg-white py-16 md:py-24">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <div class="mb-12 text-center md:mb-16">
                    <h2 class="mb-4 text-3xl font-bold text-gray-900 sm:text-4xl md:text-5xl">
                        لماذا تختارنا؟
                    </h2>
                    <p class="mx-auto max-w-2xl text-base leading-7 text-gray-600 sm:text-lg md:text-xl">
                        نتميز بمزايا فريدة تجعلنا الخيار الأمثل لشركتك
                    </p>
                </div>

                <div class="grid grid-cols-1 gap-8 lg:grid-cols-3">
                    <div
                        v-for="advantage in advantages"
                        :key="advantage.title"
                        class="group relative overflow-hidden rounded-3xl border border-gray-200 bg-white p-6 transition-all duration-300 hover:shadow-2xl md:p-8"
                    >
                        <div class="absolute left-0 top-0 h-1 w-full bg-gradient-to-r" :class="advantage.gradient"></div>

                        <div
                            class="mb-6 flex h-20 w-20 items-center justify-center rounded-2xl bg-gradient-to-br transition-transform group-hover:scale-110"
                            :class="advantage.gradient"
                        >
                            <component :is="advantage.icon" class="h-9 w-9 text-white" />
                        </div>

                        <h3 class="mb-4 text-xl font-bold text-gray-900 md:text-2xl">
                            {{ advantage.title }}
                        </h3>

                        <p class="mb-6 leading-relaxed text-gray-600">
                            {{ advantage.description }}
                        </p>

                        <div class="space-y-3">
                            <div
                                v-for="feature in advantage.features"
                                :key="feature"
                                class="flex items-center gap-2"
                            >
                                <CheckCircle class="h-5 w-5 shrink-0 text-green-500" />
                                <span class="text-gray-900">{{ feature }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-12 rounded-3xl bg-gradient-to-r from-blue-50 to-violet-50 p-6 text-center md:mt-16 md:p-12">
                    <h3 class="mb-4 text-2xl font-bold text-gray-900 md:text-3xl">
                        جاهز للبدء؟
                    </h3>
                    <p class="mx-auto mb-8 max-w-2xl text-base leading-7 text-gray-600 sm:text-lg md:text-xl">
                        انضم إلى +200 عميل راضٍ واستفد من خبرتنا في تطوير الحلول التقنية
                    </p>
                    <button
                        type="button"
                        class="w-full rounded-xl bg-gradient-to-r from-blue-600 to-violet-600 px-8 py-4 text-white transition-all hover:shadow-2xl sm:w-auto sm:px-10"
                        @click="scrollToSection('contact')"
                    >
                        احصل على استشارة مجانية
                    </button>
                </div>
            </div>
        </section>

        <section id="portfolio" class="bg-gradient-to-b from-white to-gray-50 py-16 md:py-24">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <div class="mb-12 text-center md:mb-16">
                    <h2 class="mb-4 text-3xl font-bold text-gray-900 sm:text-4xl md:text-5xl">
                        أعمالنا المميزة
                    </h2>
                    <p class="mx-auto max-w-2xl text-base leading-7 text-gray-600 sm:text-lg md:text-xl">
                        اطلع على بعض المشاريع التي أنجزناها بنجاح لعملائنا
                    </p>
                </div>

                <div class="grid grid-cols-1 gap-8 md:grid-cols-2 lg:grid-cols-3">
                    <div
                        v-for="project in portfolioProjects"
                        :key="project.title"
                        class="group overflow-hidden rounded-2xl border border-gray-200 bg-white transition-all duration-300 hover:shadow-2xl"
                    >
                        <div class="relative h-48 overflow-hidden bg-gradient-to-br from-blue-100 to-violet-100">
                            <img
                                :src="project.image"
                                :alt="project.title"
                                class="h-full w-full object-cover transition-transform duration-500 group-hover:scale-110"
                                @error="(e) => { (e.target as HTMLImageElement).src = '/asset/bk.jpg' }"
                            />

                            <div class="absolute right-4 top-4">
                                <span class="rounded-full bg-white/90 px-3 py-1 text-sm font-medium text-gray-900 backdrop-blur-sm">
                                    {{ project.category }}
                                </span>
                            </div>
                        </div>

                        <div class="p-5 md:p-6">
                            <h3 class="mb-2 text-xl font-bold text-gray-900 transition-colors group-hover:text-blue-600">
                                {{ project.title }}
                            </h3>
                            <p class="mb-4 leading-relaxed text-gray-600">
                                {{ project.description }}
                            </p>

                            <div class="mb-4 flex flex-wrap gap-2">
                                <span
                                    v-for="tag in project.tags"
                                    :key="tag"
                                    class="rounded-full bg-blue-50 px-3 py-1 text-xs text-blue-700"
                                >
                                    {{ tag }}
                                </span>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="relative overflow-hidden bg-gradient-to-br from-slate-900 to-slate-800 py-16 text-white md:py-24">
            <div class="absolute inset-0 opacity-10">
                <div class="absolute right-0 top-0 h-72 w-72 rounded-full bg-blue-500 blur-3xl md:h-96 md:w-96"></div>
                <div class="absolute bottom-0 left-0 h-72 w-72 rounded-full bg-violet-500 blur-3xl md:h-96 md:w-96"></div>
            </div>

            <div class="relative mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 items-center gap-12 lg:grid-cols-2">
                    <div>
                        <div class="mb-6 inline-flex items-center gap-2 rounded-full bg-blue-500/20 px-4 py-2">
                            <Sparkles class="h-4 w-4" />
                            <span class="text-sm">تقنيات المستقبل</span>
                        </div>

                        <h2 class="mb-6 text-3xl font-bold leading-tight sm:text-4xl md:text-5xl">
                            نستخدم أحدث تقنيات
                            <br />
                            <span class="bg-gradient-to-r from-blue-400 to-violet-400 bg-clip-text text-transparent">
                                الذكاء الاصطناعي
                            </span>
                        </h2>

                        <p class="mb-8 text-base leading-8 text-gray-300 sm:text-lg md:text-xl">
                            نوظف أحدث تقنيات الذكاء الاصطناعي والتعلم الآلي لبناء حلول ذكية تساعد عملك على النمو والتطور في العصر الرقمي
                        </p>

                        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                            <div
                                v-for="feature in aiFeatures"
                                :key="feature.title"
                                class="flex items-start gap-3"
                            >
                                <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-lg bg-blue-500/20">
                                    <component :is="feature.icon" class="h-6 w-6 text-blue-400" />
                                </div>
                                <div>
                                    <h3 class="mb-1 font-bold">{{ feature.title }}</h3>
                                    <p class="text-sm text-gray-400">{{ feature.description }}</p>
                                </div>
                            </div>
                        </div>

                        <button
                            type="button"
                            class="mt-8 w-full rounded-xl bg-white px-8 py-4 font-medium text-slate-900 transition-all hover:shadow-2xl sm:w-auto"
                            @click="scrollToSection('contact')"
                        >
                            اكتشف حلولنا الذكية
                        </button>
                    </div>

                    <div class="relative">
                        <div class="rounded-3xl border border-white/10 bg-gradient-to-br from-blue-500/10 to-violet-500/10 p-5 backdrop-blur-sm sm:p-6 md:p-8">
                            <div class="grid grid-cols-2 gap-4 sm:gap-6">
                                <div class="rounded-2xl border border-blue-400/20 bg-blue-500/20 p-4 backdrop-blur-sm sm:p-6">
                                    <div class="mb-2 text-3xl font-bold sm:text-4xl">98%</div>
                                    <div class="text-sm text-gray-300">دقة النماذج</div>
                                </div>
                                <div class="rounded-2xl border border-violet-400/20 bg-violet-500/20 p-4 backdrop-blur-sm sm:p-6">
                                    <div class="mb-2 text-3xl font-bold sm:text-4xl">50+</div>
                                    <div class="text-sm text-gray-300">مشروع AI</div>
                                </div>
                                <div class="rounded-2xl border border-pink-400/20 bg-pink-500/20 p-4 backdrop-blur-sm sm:p-6">
                                    <div class="mb-2 text-3xl font-bold sm:text-4xl">10x</div>
                                    <div class="text-sm text-gray-300">تحسين الكفاءة</div>
                                </div>
                                <div class="rounded-2xl border border-cyan-400/20 bg-cyan-500/20 p-4 backdrop-blur-sm sm:p-6">
                                    <div class="mb-2 text-3xl font-bold sm:text-4xl">24/7</div>
                                    <div class="text-sm text-gray-300">عمل مستمر</div>
                                </div>
                            </div>

                            <div class="mt-6 rounded-2xl border border-white/10 bg-white/5 p-5 backdrop-blur-sm sm:mt-8 sm:p-6">
                                <div class="mb-4 flex items-center gap-3">
                                    <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-gradient-to-br from-blue-500 to-violet-500">
                                        <Brain class="h-5 w-5" />
                                    </div>
                                    <div>
                                        <div class="font-bold">نموذج ذكي متقدم</div>
                                        <div class="text-xs text-gray-400">قيد التشغيل</div>
                                    </div>
                                </div>

                                <div class="space-y-2">
                                    <div class="h-2 overflow-hidden rounded-full bg-white/10">
                                        <div class="h-full w-[95%] bg-gradient-to-r from-blue-500 to-violet-500"></div>
                                    </div>
                                    <div class="text-left text-xs text-gray-400">معالجة البيانات: 95%</div>
                                </div>
                            </div>
                        </div>

                        <div class="absolute -right-6 -top-6 h-32 w-32 rounded-full bg-blue-500/20 blur-2xl"></div>
                        <div class="absolute -bottom-6 -left-6 h-32 w-32 rounded-full bg-violet-500/20 blur-2xl"></div>
                    </div>
                </div>
            </div>
        </section>

        <!-- App Section -->
        <section class="hidden py-20 bg-white">
            <div class="container mx-auto px-4">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center max-w-6xl mx-auto">
                    <div class="app-section-left animate-slide-in-left">
                        <div class="flex items-center gap-2 mb-4">
                            <Sparkles class="w-6 h-6 text-blue-600" />
                            <span class="text-blue-600 font-medium">تطبيقات احترافية</span>
                </div>

                        <h2 class="text-4xl md:text-5xl lg:text-6xl font-bold text-gray-900 mb-6">
                            احصل على تطبيقك<br />
                            بتصميم عصري
                        </h2>
                        
                        <p class="mb-6 opacity-70 text-lg text-gray-600">
                            نقوم بتطوير تطبيقات الهاتف والويب باستخدام أحدث التقنيات والأدوات، مع التركيز على تجربة المستخدم والأداء العالي.
                        </p>

                        <ul class="space-y-3 mb-8">
                            <li 
                                v-for="item in [
                                    'تصميم واجهات مستخدم جذابة',
                                    'أداء سريع وموثوق',
                                    'متوافق مع جميع الأجهزة',
                                    'دعم فني متواصل'
                                ]"
                                :key="item"
                                class="flex items-center gap-3"
                            >
                                <div class="w-6 h-6 rounded-full bg-blue-600 flex items-center justify-center flex-shrink-0">
                                    <div class="w-2 h-2 rounded-full bg-white"></div>
                        </div>
                                <span class="text-gray-700">{{ item }}</span>
                            </li>
                        </ul>

                        <Button size="lg" class="text-white hover:opacity-90 transition-opacity" style="background-color: #4b3da6;">
                            <Smartphone class="ml-2 h-5 w-5" />
                            ابدأ تطبيقك الآن
                        </Button>
                    </div>
                    
                    <div class="relative app-section-right animate-slide-in-right">
                        <div class="relative rounded-2xl overflow-hidden shadow-2xl">
                            <img
                                src="/asset/mob.png"
                                alt="Mobile App Development"
                                class="w-full h-auto"
                                @error="(e) => { (e.target as HTMLImageElement).src = '/asset/bk.jpg' }"
                            />
                    </div>
                    
                        <div class="absolute -z-10 -top-6 -right-6 h-40 w-40 rounded-full bg-gray-200/40 blur-3xl"></div>
                        <div class="absolute -z-10 -bottom-6 -left-6 h-40 w-40 rounded-full bg-gray-200/40 blur-3xl"></div>
                        </div>
                    </div>
            </div>
        </section>

        <!-- Website Section -->
        <section class="hidden py-20 bg-white">
            <div class="container mx-auto px-4">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center max-w-6xl mx-auto">
                    <div class="relative order-2 lg:order-1 website-section-left animate-slide-in-left">
                        <div class="relative rounded-2xl overflow-hidden shadow-2xl">
                            <img
                                src="/asset/website.png"
                                alt="Web Design"
                                class="w-full h-auto"
                                @error="(e) => { (e.target as HTMLImageElement).src = '/asset/bk.jpg' }"
                            />
                        </div>

                        <div class="absolute -z-10 -top-6 -left-6 h-40 w-40 rounded-full bg-gray-200/50 blur-3xl"></div>
                    </div>
                    
                    <div class="order-1 lg:order-2 website-section-right animate-slide-in-right">
                        <div class="flex items-center gap-2 mb-4">
                            <Globe class="w-6 h-6 text-gray-900" />
                            <span class="text-gray-900 font-medium">مواقع احترافية</span>
                        </div>

                        <h2 class="text-4xl md:text-5xl lg:text-6xl font-bold text-gray-900 mb-6">
                            فرصتك للحصول<br />
                            على موقع متكامل
                        </h2>
                        
                        <p class="mb-6 opacity-70 text-lg text-gray-600">
                            نبني مواقع ويب عصرية ومتجاوبة مع جميع الأجهزة، مع التركيز على السرعة والأمان وتجربة المستخدم المتميزة.
                        </p>

                        <div class="grid grid-cols-2 gap-4 mb-8">
                            <div 
                                v-for="item in [
                                    { label: 'تصميم متجاوب', value: '100%' },
                                    { label: 'أداء عالي', value: 'A+' },
                                    { label: 'أمان قوي', value: 'SSL' },
                                    { label: 'SEO محسن', value: '⭐' },
                                ]"
                                :key="item.label"
                                class="p-4 bg-gray-50 rounded-lg"
                            >
                                <div class="text-2xl font-bold text-gray-900 mb-1">{{ item.value }}</div>
                                <div class="opacity-70 text-gray-600">{{ item.label }}</div>
                            </div>
                            </div>

                        <Button size="lg" class="text-white hover:opacity-90 transition-opacity" style="background-color: #4b3da6;">
                            اطلب موقعك الآن
                            <ArrowRight class="mr-2 h-5 w-5" />
                        </Button>
                </div>
                </div>
            </div>
        </section>

        <!-- Goals Section -->
        <section class="hidden relative overflow-hidden border-t border-gray-200/80 bg-[#f5f5f7] py-20 text-gray-900">
            <div class="container relative z-10 mx-auto px-4">
                <div class="mb-16 animate-fade-in-up text-center">
                    <h2 class="mb-3 text-3xl font-semibold tracking-tight md:text-4xl">هدفنا لعام 2026</h2>
                    <p class="mx-auto max-w-2xl text-base text-gray-500 md:text-lg">
                        نسعى لتحقيق التميز والريادة في مجال التكنولوجيا وتقديم أفضل الحلول البرمجية لعملائنا.
                    </p>
                </div>

                <div class="mx-auto grid max-w-5xl grid-cols-2 gap-6 lg:grid-cols-4">
                    <div
                        v-for="(goal, index) in goals"
                        :key="goal.label"
                        class="goal-item rounded-3xl border border-gray-200/90 bg-white p-6 text-center shadow-sm"
                        :style="{ animationDelay: `${index * 0.1}s` }"
                    >
                        <div class="mx-auto mb-4 flex h-14 w-14 items-center justify-center rounded-2xl bg-gray-100">
                            <component :is="goal.icon" class="h-7 w-7 text-gray-900" />
                        </div>
                        <div class="mb-1 text-3xl font-semibold tracking-tight">{{ goal.number }}</div>
                        <div class="text-sm text-gray-500">{{ goal.label }}</div>
                    </div>
                </div>
            </div>
        </section>

        <!-- About Us Section -->
        <section id="about" class="hidden py-20 bg-gray-50">
            <div class="container mx-auto px-4">
                <div class="text-center mb-16 max-w-3xl mx-auto animate-fade-in-up">
                    <h2 class="text-4xl md:text-5xl lg:text-6xl font-bold text-gray-900 mb-6">
                        فرصتك لنقل فكرتك إلى الإنترنت وتطويرها
                    </h2>
                    <p class="opacity-70 text-lg">
                        مجموعة شباب ذوي خبرات في أهم المجالات التقنية، عملنا على مئات المشاريع التقنية، منصة إكتمل هي المكان الصحيح لنقل فكرتك إلى الإنترنت وإدارتها وإيصالها إلى أكبر عدد من الناس بأحدث الوسائل.
                    </p>
                        </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 max-w-6xl mx-auto">
                    <div
                        v-for="(feature, index) in aboutFeatures"
                        :key="feature.title"
                        class="about-feature-card"
                        :style="{ animationDelay: `${index * 0.1}s` }"
                    >
                        <Card class="p-6 h-full hover:shadow-lg transition-all duration-300 hover:-translate-y-1">
                            <div class="w-12 h-12 rounded-lg flex items-center justify-center mb-4" style="background-color: #4b3da6;">
                                <component :is="feature.icon" class="w-6 h-6 text-white" />
                    </div>
                            <h3 class="text-xl font-bold text-gray-900 mb-2">{{ feature.title }}</h3>
                            <p class="opacity-70 text-gray-600">{{ feature.description }}</p>
                        </Card>
                </div>
                </div>
            </div>
        </section>

                <!-- Legacy Services Grid (Hidden) -->
        <section class="py-20 px-4 bg-white hidden">
            <div class="max-w-7xl mx-auto">
                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                    <Link href="/services/mobile-development" class="rounded-3xl border border-gray-100 bg-white p-8 shadow-sm transition-all duration-300 hover:shadow-md group cursor-pointer">
                        <div class="w-16 h-16 bg-gray-100 rounded-2xl flex items-center justify-center mb-6 group-hover:bg-gray-200 transition-colors">
                            <Smartphone class="w-8 h-8 text-gray-700" />
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-4 group-hover:text-blue-600 transition-colors">{{ t('serviceMobile') }}</h3>
                        <p class="text-gray-600 mb-6 leading-relaxed">
                            {{ t('serviceMobileDesc') }}
                        </p>
                        <ul class="space-y-2 text-sm text-gray-400">
                            <li class="flex items-center gap-2">
                                <div class="w-1.5 h-1.5 bg-blue-600 rounded-full"></div>
                                <span class="text-gray-600">iOS & Android Development</span>
                            </li>
                            <li class="flex items-center gap-2">
                                <div class="w-1.5 h-1.5 bg-purple-600 rounded-full"></div>
                                <span class="text-gray-600">Cross-platform Solutions</span>
                            </li>
                            <li class="flex items-center gap-2">
                                <div class="w-1.5 h-1.5 bg-cyan-600 rounded-full"></div>
                                <span class="text-gray-600">App Store Optimization</span>
                            </li>
                        </ul>
                    </Link>

                    <Link href="/services/web-development" class="rounded-3xl border border-gray-100 bg-white p-8 shadow-sm transition-all duration-300 hover:shadow-md group cursor-pointer">
                        <div class="w-16 h-16 bg-gray-100 rounded-2xl flex items-center justify-center mb-6 group-hover:bg-gray-200 transition-colors">
                            <Globe class="w-8 h-8 text-gray-700" />
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-4 group-hover:text-blue-600 transition-colors">{{ t('serviceWeb') }}</h3>
                        <p class="text-gray-600 mb-6 leading-relaxed">
                            {{ t('serviceWebDesc') }}
                        </p>
                        <ul class="space-y-2 text-sm text-gray-600">
                            <li class="flex items-center gap-2">
                                <div class="w-1.5 h-1.5 bg-blue-600 rounded-full"></div>
                                <span>Progressive Web Apps</span>
                            </li>
                            <li class="flex items-center gap-2">
                                <div class="w-1.5 h-1.5 bg-purple-600 rounded-full"></div>
                                <span>Enterprise Solutions</span>
                            </li>
                            <li class="flex items-center gap-2">
                                <div class="w-1.5 h-1.5 bg-cyan-600 rounded-full"></div>
                                <span>Cloud Integration</span>
                            </li>
                        </ul>
                    </Link>

                    <Link href="/services/chatbot-automation" class="rounded-3xl border border-gray-100 bg-white p-8 shadow-sm transition-all duration-300 hover:shadow-md group cursor-pointer">
                        <div class="w-16 h-16 bg-gray-100 rounded-2xl flex items-center justify-center mb-6 group-hover:bg-gray-200 transition-colors">
                            <Zap class="w-8 h-8 text-gray-700" />
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-4 group-hover:text-blue-600 transition-colors">{{ t('serviceAI') }}</h3>
                        <p class="text-gray-600 mb-6 leading-relaxed">
                            {{ t('serviceAIDesc') }}
                        </p>
                        <ul class="space-y-2 text-sm text-gray-600">
                            <li class="flex items-center gap-2">
                                <div class="w-1.5 h-1.5 bg-blue-600 rounded-full"></div>
                                <span>Machine Learning Models</span>
                            </li>
                            <li class="flex items-center gap-2">
                                <div class="w-1.5 h-1.5 bg-purple-600 rounded-full"></div>
                                <span>Process Automation</span>
                            </li>
                            <li class="flex items-center gap-2">
                                <div class="w-1.5 h-1.5 bg-cyan-600 rounded-full"></div>
                                <span>Data Analytics</span>
                            </li>
                        </ul>
                    </Link>

                    <Link href="/services/cloud-devops" class="rounded-3xl border border-gray-100 bg-white p-8 shadow-sm transition-all duration-300 hover:shadow-md group cursor-pointer">
                        <div class="w-16 h-16 bg-gray-100 rounded-2xl flex items-center justify-center mb-6 group-hover:bg-gray-200 transition-colors">
                            <svg class="w-8 h-8 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 15a4 4 0 004 4h9a5 5 0 10-.1-9.999 5.002 5.002 0 10-9.78 2.096A4.001 4.001 0 003 15z"/>
                            </svg>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-4 group-hover:text-blue-600 transition-colors">{{ t('serviceCloud') }}</h3>
                        <p class="text-gray-600 mb-6 leading-relaxed">
                            {{ t('serviceCloudDesc') }}
                        </p>
                        <ul class="space-y-2 text-sm text-gray-600">
                            <li class="flex items-center gap-2">
                                <div class="w-1.5 h-1.5 bg-blue-600 rounded-full"></div>
                                <span>AWS & Azure Deployment</span>
                            </li>
                            <li class="flex items-center gap-2">
                                <div class="w-1.5 h-1.5 bg-purple-600 rounded-full"></div>
                                <span>Docker & Kubernetes</span>
                            </li>
                            <li class="flex items-center gap-2">
                                <div class="w-1.5 h-1.5 bg-cyan-600 rounded-full"></div>
                                <span>CI/CD Pipelines</span>
                            </li>
                        </ul>
                    </Link>

                    <Link href="/services/consulting" class="rounded-3xl border border-gray-100 bg-white p-8 shadow-sm transition-all duration-300 hover:shadow-md group cursor-pointer">
                        <div class="w-16 h-16 bg-gray-100 rounded-2xl flex items-center justify-center mb-6 group-hover:bg-gray-200 transition-colors">
                            <svg class="w-8 h-8 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/>
                            </svg>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-4 group-hover:text-blue-600 transition-colors">{{ t('serviceConsulting') }}</h3>
                        <p class="text-gray-600 mb-6 leading-relaxed">
                            {{ t('serviceConsultingDesc') }}
                        </p>
                        <ul class="space-y-2 text-sm text-gray-600">
                            <li class="flex items-center gap-2">
                                <div class="w-1.5 h-1.5 bg-blue-600 rounded-full"></div>
                                <span>Technology Strategy</span>
                            </li>
                            <li class="flex items-center gap-2">
                                <div class="w-1.5 h-1.5 bg-purple-600 rounded-full"></div>
                                <span>Digital Transformation</span>
                            </li>
                            <li class="flex items-center gap-2">
                                <div class="w-1.5 h-1.5 bg-cyan-600 rounded-full"></div>
                                <span>Performance Optimization</span>
                            </li>
                        </ul>
                    </Link>

                    <Link href="/services/chatbot-automation" class="rounded-3xl border border-gray-100 bg-white p-8 shadow-sm transition-all duration-300 hover:shadow-md group cursor-pointer">
                        <div class="w-16 h-16 bg-gray-100 rounded-2xl flex items-center justify-center mb-6 group-hover:bg-gray-200 transition-colors">
                            <MessageCircle class="w-8 h-8 text-gray-700" />
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-4 group-hover:text-blue-600 transition-colors">{{ t('serviceChatbot') }}</h3>
                        <p class="text-gray-600 mb-6 leading-relaxed">
                            {{ t('serviceChatbotDesc') }}
                        </p>
                        <ul class="space-y-2 text-sm text-gray-600">
                            <li class="flex items-center gap-2">
                                <div class="w-1.5 h-1.5 bg-blue-600 rounded-full"></div>
                                <span>Customer Support Bots</span>
                            </li>
                            <li class="flex items-center gap-2">
                                <div class="w-1.5 h-1.5 bg-purple-600 rounded-full"></div>
                                <span>Sales Automation</span>
                            </li>
                            <li class="flex items-center gap-2">
                                <div class="w-1.5 h-1.5 bg-cyan-600 rounded-full"></div>
                                <span>Multi-language Support</span>
                            </li>
                        </ul>
                    </Link>
                </div>
            </div>
        </section>

        <!-- Why Choose Us -->
        <section class="hidden py-20 px-4 bg-white">
            <div class="max-w-7xl mx-auto">
                <div class="text-center mb-16">
                    <h2 class="text-4xl md:text-6xl font-bold text-gray-900 mb-6">{{ t('whyChooseUsTitle') }}</h2>
                    <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                        {{ t('whyChooseUsSubtitle') }}
                    </p>
                </div>

                <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-8">
                    <!-- Feature 1 -->
                    <div class="rounded-3xl border border-gray-100 bg-white p-8 shadow-sm transition-all duration-300 hover:shadow-md group text-center">
                        <div class="w-16 h-16 bg-gray-100 rounded-2xl flex items-center justify-center mx-auto mb-6 group-hover:bg-gray-200 transition-colors">
                            <Award class="w-8 h-8 text-gray-700" />
                                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-4">{{ t('whyChooseUsExpert') }}</h3>
                        <p class="text-gray-600 leading-relaxed">
                            {{ t('whyChooseUsExpertDesc') }}
                        </p>
                                    </div>

                    <!-- Feature 2 -->
                    <div class="rounded-3xl border border-gray-100 bg-white p-8 shadow-sm transition-all duration-300 hover:shadow-md group text-center">
                        <div class="w-16 h-16 bg-gray-100 rounded-2xl flex items-center justify-center mx-auto mb-6 group-hover:bg-gray-200 transition-colors">
                            <Clock class="w-8 h-8 text-gray-700" />
                                    </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-4">{{ t('whyChooseUsDelivery') }}</h3>
                        <p class="text-gray-600 leading-relaxed">
                            {{ t('whyChooseUsDeliveryDesc') }}
                        </p>
                                </div>

                    <!-- Feature 3 -->
                    <div class="rounded-3xl border border-gray-100 bg-white p-8 shadow-sm transition-all duration-300 hover:shadow-md group text-center">
                        <div class="w-16 h-16 bg-gray-100 rounded-2xl flex items-center justify-center mx-auto mb-6 group-hover:bg-gray-200 transition-colors">
                            <Shield class="w-8 h-8 text-gray-700" />
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-4">{{ t('whyChooseUsSecure') }}</h3>
                        <p class="text-gray-600 leading-relaxed">
                            {{ t('whyChooseUsSecureDesc') }}
                        </p>
                                    </div>

                    <!-- Feature 4 -->
                    <div class="rounded-3xl border border-gray-100 bg-white p-8 shadow-sm transition-all duration-300 hover:shadow-md group text-center">
                        <div class="w-16 h-16 bg-gray-100 rounded-2xl flex items-center justify-center mx-auto mb-6 group-hover:bg-gray-200 transition-colors">
                            <Users class="w-8 h-8 text-gray-700" />
                                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-4">{{ t('whyChooseUsClient') }}</h3>
                        <p class="text-gray-600 leading-relaxed">
                            {{ t('whyChooseUsClientDesc') }}
                        </p>
                                        </div>
                                    </div>

                <!-- Additional Features Grid -->
                <div class="grid md:grid-cols-3 gap-6 mt-12">
                    <div class="flex items-start gap-4 p-6 bg-gray-50 rounded-2xl hover:bg-gray-100 transition-colors">
                        <div class="flex-shrink-0">
                            <CheckCircle class="w-6 h-6 text-green-500" />
                        </div>
                                    <div>
                            <h4 class="font-semibold text-gray-900 mb-2">{{ t('whyChooseUsQA') }}</h4>
                            <p class="text-sm text-gray-600">{{ t('whyChooseUsQADesc') }}</p>
                                            </div>
                                    </div>

                    <div class="flex items-start gap-4 p-6 bg-gray-50 rounded-2xl hover:bg-gray-100 transition-colors">
                        <div class="flex-shrink-0">
                            <CheckCircle class="w-6 h-6 text-green-500" />
                                        </div>
                        <div>
                            <h4 class="font-semibold text-gray-900 mb-2">{{ t('whyChooseUsSupport') }}</h4>
                            <p class="text-sm text-gray-600">{{ t('whyChooseUsSupportDesc') }}</p>
                                        </div>
                                    </div>

                    <div class="flex items-start gap-4 p-6 bg-gray-50 rounded-2xl hover:bg-gray-100 transition-colors">
                        <div class="flex-shrink-0">
                            <CheckCircle class="w-6 h-6 text-green-500" />
                                            </div>
                        <div>
                            <h4 class="font-semibold text-gray-900 mb-2">{{ t('whyChooseUsScalable') }}</h4>
                            <p class="text-sm text-gray-600">{{ t('whyChooseUsScalableDesc') }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
        </section>

        <!-- How We Work (Process) -->
        <section class="hidden py-20 px-4 bg-gray-50">
            <div class="max-w-7xl mx-auto">
                <div class="text-center mb-16">
                    <h2 class="text-4xl md:text-6xl font-bold text-gray-900 mb-6">{{ t('howWeWorkTitle') }}</h2>
                    <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                        {{ t('howWeWorkSubtitle') }}
                    </p>
                        </div>

                <!-- Process Steps -->
                <div class="relative">
                    <!-- Connection Line (Desktop) -->
                    <div class="hidden lg:block absolute top-1/2 left-0 right-0 h-0.5 bg-gray-300 transform -translate-y-1/2" style="top: 50%;"></div>

                    <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-8 relative">
                        <!-- Step 1 -->
                        <div class="bg-white backdrop-blur-lg rounded-3xl p-8 border border-gray-200 hover:border-gray-300 hover:shadow-lg transition-all duration-300 group text-center relative z-10">
                            <div class="w-20 h-20 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-6 group-hover:bg-gray-200 transition-colors shadow-lg">
                                <div class="w-16 h-16 bg-white rounded-full flex items-center justify-center">
                                    <Search class="w-8 h-8 text-gray-700" />
                    </div>
                            </div>
                            <div class="absolute -top-4 left-1/2 transform -translate-x-1/2 w-8 h-8 bg-gray-700 rounded-full flex items-center justify-center text-white font-bold text-sm shadow-lg">
                                1
                            </div>
                            <h3 class="text-xl font-bold text-gray-900 mb-4">{{ t('howWeWorkDiscovery') }}</h3>
                            <p class="text-gray-600 leading-relaxed">
                                {{ t('howWeWorkDiscoveryDesc') }}
                            </p>
                </div>

                        <!-- Step 2 -->
                        <div class="bg-white backdrop-blur-lg rounded-3xl p-8 border border-gray-200 hover:border-gray-300 hover:shadow-lg transition-all duration-300 group text-center relative z-10">
                            <div class="w-20 h-20 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-6 group-hover:bg-gray-200 transition-colors shadow-lg">
                                <div class="w-16 h-16 bg-white rounded-full flex items-center justify-center">
                                    <FileText class="w-8 h-8 text-gray-700" />
                                </div>
                            </div>
                            <div class="absolute -top-4 left-1/2 transform -translate-x-1/2 w-8 h-8 bg-gray-700 rounded-full flex items-center justify-center text-white font-bold text-sm shadow-lg">
                                2
                            </div>
                            <h3 class="text-xl font-bold text-gray-900 mb-4">{{ t('howWeWorkPlanning') }}</h3>
                            <p class="text-gray-600 leading-relaxed">
                                {{ t('howWeWorkPlanningDesc') }}
                            </p>
                        </div>

                        <!-- Step 3 -->
                        <div class="bg-white backdrop-blur-lg rounded-3xl p-8 border border-gray-200 hover:border-gray-300 hover:shadow-lg transition-all duration-300 group text-center relative z-10">
                            <div class="w-20 h-20 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-6 group-hover:bg-gray-200 transition-colors shadow-lg">
                                <div class="w-16 h-16 bg-white rounded-full flex items-center justify-center">
                                    <Code class="w-8 h-8 text-gray-700" />
                                </div>
                            </div>
                            <div class="absolute -top-4 left-1/2 transform -translate-x-1/2 w-8 h-8 bg-gray-700 rounded-full flex items-center justify-center text-white font-bold text-sm shadow-lg">
                                3
                            </div>
                            <h3 class="text-xl font-bold text-gray-900 mb-4">{{ t('howWeWorkDevelopment') }}</h3>
                            <p class="text-gray-600 leading-relaxed">
                                {{ t('howWeWorkDevelopmentDesc') }}
                            </p>
                        </div>

                        <!-- Step 4 -->
                        <div class="bg-white backdrop-blur-lg rounded-3xl p-8 border border-gray-200 hover:border-gray-300 hover:shadow-lg transition-all duration-300 group text-center relative z-10">
                            <div class="w-20 h-20 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-6 group-hover:bg-gray-200 transition-colors shadow-lg">
                                <div class="w-16 h-16 bg-white rounded-full flex items-center justify-center">
                                    <Rocket class="w-8 h-8 text-gray-700" />
                                </div>
                            </div>
                            <div class="absolute -top-4 left-1/2 transform -translate-x-1/2 w-8 h-8 bg-gray-700 rounded-full flex items-center justify-center text-white font-bold text-sm shadow-lg">
                                4
                            </div>
                            <h3 class="text-xl font-bold text-gray-900 mb-4">{{ t('howWeWorkLaunch') }}</h3>
                            <p class="text-gray-600 leading-relaxed">
                                {{ t('howWeWorkLaunchDesc') }}
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Process Benefits -->
                <div class="mt-16 grid md:grid-cols-3 gap-6">
                    <div class="text-center p-6">
                        <div class="inline-flex items-center justify-center w-12 h-12 bg-blue-100 rounded-full mb-4">
                            <CheckCircle class="w-6 h-6 text-blue-600" />
                        </div>
                        <h4 class="font-semibold text-gray-900 mb-2">{{ t('howWeWorkTransparent') }}</h4>
                        <p class="text-sm text-gray-600">{{ t('howWeWorkTransparentDesc') }}</p>
                    </div>

                    <div class="text-center p-6">
                        <div class="inline-flex items-center justify-center w-12 h-12 bg-purple-100 rounded-full mb-4">
                            <CheckCircle class="w-6 h-6 text-purple-600" />
                        </div>
                        <h4 class="font-semibold text-gray-900 mb-2">{{ t('howWeWorkAgile') }}</h4>
                        <p class="text-sm text-gray-600">{{ t('howWeWorkAgileDesc') }}</p>
                    </div>

                    <div class="text-center p-6">
                        <div class="inline-flex items-center justify-center w-12 h-12 bg-green-100 rounded-full mb-4">
                            <CheckCircle class="w-6 h-6 text-green-600" />
                        </div>
                        <h4 class="font-semibold text-gray-900 mb-2">{{ t('howWeWorkQuality') }}</h4>
                        <p class="text-sm text-gray-600">{{ t('howWeWorkQualityDesc') }}</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Industries We Serve -->
        <section class="hidden py-20 px-4 bg-white">
            <div class="max-w-7xl mx-auto">
                <div class="text-center mb-16">
                    <h2 class="text-4xl md:text-6xl font-bold text-gray-900 mb-6">{{ t('industriesTitle') }}</h2>
                    <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                        {{ t('industriesSubtitle') }}
                    </p>
                </div>

                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                    <!-- E-commerce -->
                    <div class="rounded-3xl border border-gray-100 bg-white p-8 shadow-sm transition-all duration-300 hover:shadow-md group">
                        <div class="w-16 h-16 bg-gray-100 rounded-2xl flex items-center justify-center mb-6 group-hover:bg-gray-200 transition-colors">
                            <ShoppingCart class="w-8 h-8 text-gray-700" />
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-4">{{ t('industryEcommerce') }}</h3>
                        <p class="text-gray-600 leading-relaxed">
                            {{ t('industryEcommerceDesc') }}
                        </p>
                    </div>

                    <!-- Logistics -->
                    <div class="rounded-3xl border border-gray-100 bg-white p-8 shadow-sm transition-all duration-300 hover:shadow-md group">
                        <div class="w-16 h-16 bg-gray-100 rounded-2xl flex items-center justify-center mb-6 group-hover:bg-gray-200 transition-colors">
                            <Truck class="w-8 h-8 text-gray-700" />
                    </div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-4">{{ t('industryLogistics') }}</h3>
                        <p class="text-gray-600 leading-relaxed">
                            {{ t('industryLogisticsDesc') }}
                        </p>
                        </div>

                    <!-- Healthcare -->
                    <div class="rounded-3xl border border-gray-100 bg-white p-8 shadow-sm transition-all duration-300 hover:shadow-md group">
                        <div class="w-16 h-16 bg-gray-100 rounded-2xl flex items-center justify-center mb-6 group-hover:bg-gray-200 transition-colors">
                            <Heart class="w-8 h-8 text-gray-700" />
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-4">{{ t('industryHealthcare') }}</h3>
                        <p class="text-gray-600 leading-relaxed">
                            {{ t('industryHealthcareDesc') }}
                        </p>
                    </div>

                    <!-- Fintech -->
                    <div class="rounded-3xl border border-gray-100 bg-white p-8 shadow-sm transition-all duration-300 hover:shadow-md group">
                        <div class="w-16 h-16 bg-gray-100 rounded-2xl flex items-center justify-center mb-6 group-hover:bg-gray-200 transition-colors">
                            <CreditCard class="w-8 h-8 text-gray-700" />
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-4">{{ t('industryFintech') }}</h3>
                        <p class="text-gray-600 leading-relaxed">
                            {{ t('industryFintechDesc') }}
                        </p>
                    </div>

                    <!-- Education -->
                    <div class="rounded-3xl border border-gray-100 bg-white p-8 shadow-sm transition-all duration-300 hover:shadow-md group">
                        <div class="w-16 h-16 bg-gray-100 rounded-2xl flex items-center justify-center mb-6 group-hover:bg-gray-200 transition-colors">
                            <GraduationCap class="w-8 h-8 text-gray-700" />
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-4">{{ t('industryEducation') }}</h3>
                        <p class="text-gray-600 leading-relaxed">
                            {{ t('industryEducationDesc') }}
                        </p>
                    </div>

                    <!-- Real Estate -->
                    <div class="rounded-3xl border border-gray-100 bg-white p-8 shadow-sm transition-all duration-300 hover:shadow-md group">
                        <div class="w-16 h-16 bg-gray-100 rounded-2xl flex items-center justify-center mb-6 group-hover:bg-gray-200 transition-colors">
                            <Building class="w-8 h-8 text-gray-700" />
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-4">{{ t('industryRealEstate') }}</h3>
                        <p class="text-gray-600 leading-relaxed">
                            {{ t('industryRealEstateDesc') }}
                        </p>
                    </div>

                    <!-- Cloud Kitchen -->
                    <div class="rounded-3xl border border-gray-100 bg-white p-8 shadow-sm transition-all duration-300 hover:shadow-md group md:col-span-2 lg:col-span-1">
                        <div class="w-16 h-16 bg-gray-100 rounded-2xl flex items-center justify-center mb-6 group-hover:bg-gray-200 transition-colors">
                            <UtensilsCrossed class="w-8 h-8 text-gray-700" />
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-4">{{ t('industryCloudKitchen') }}</h3>
                        <p class="text-gray-600 leading-relaxed">
                            {{ t('industryCloudKitchenDesc') }}
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Testimonials -->
        <section class="hidden py-20 px-4 bg-gray-50">
            <div class="max-w-7xl mx-auto">
                <div class="text-center mb-16">
                    <h2 class="text-4xl md:text-6xl font-bold text-gray-900 mb-6">{{ t('testimonialsTitle') }}</h2>
                    <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                        {{ t('testimonialsSubtitle') }}
                    </p>
                </div>

                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                    <!-- Testimonial 1 -->
                    <div class="bg-white rounded-3xl p-8 border border-gray-200 hover:border-gray-300 hover:shadow-lg transition-all duration-300">
                        <div class="flex items-center gap-1 mb-4">
                            <Star class="w-5 h-5 fill-yellow-400 text-yellow-400" />
                            <Star class="w-5 h-5 fill-yellow-400 text-yellow-400" />
                            <Star class="w-5 h-5 fill-yellow-400 text-yellow-400" />
                            <Star class="w-5 h-5 fill-yellow-400 text-yellow-400" />
                            <Star class="w-5 h-5 fill-yellow-400 text-yellow-400" />
                        </div>
                        <Quote class="w-8 h-8 text-blue-500 mb-4 opacity-50" />
                        <p class="text-gray-600 mb-6 leading-relaxed">
                            "iTab delivered an exceptional e-commerce platform that exceeded our expectations. Their team's expertise and attention to detail made all the difference."
                        </p>
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 bg-gradient-to-r from-blue-500 to-purple-500 rounded-full flex items-center justify-center text-white font-bold">
                                JD
                            </div>
                    <div>
                                <h4 class="font-semibold text-gray-900">John Doe</h4>
                                <p class="text-sm text-gray-500">CEO, TechStore</p>
                            </div>
                        </div>
                    </div>

                    <!-- Testimonial 2 -->
                    <div class="bg-white rounded-3xl p-8 border border-gray-200 hover:border-gray-300 hover:shadow-lg transition-all duration-300">
                        <div class="flex items-center gap-1 mb-4">
                            <Star class="w-5 h-5 fill-yellow-400 text-yellow-400" />
                            <Star class="w-5 h-5 fill-yellow-400 text-yellow-400" />
                            <Star class="w-5 h-5 fill-yellow-400 text-yellow-400" />
                            <Star class="w-5 h-5 fill-yellow-400 text-yellow-400" />
                            <Star class="w-5 h-5 fill-yellow-400 text-yellow-400" />
                        </div>
                        <Quote class="w-8 h-8 text-blue-500 mb-4 opacity-50" />
                        <p class="text-gray-600 mb-6 leading-relaxed">
                            "The healthcare management system they built for us has transformed our operations. Professional, reliable, and always responsive to our needs."
                        </p>
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 bg-gradient-to-r from-blue-500 to-purple-500 rounded-full flex items-center justify-center text-white font-bold">
                                SM
                            </div>
                    <div>
                                <h4 class="font-semibold text-gray-900">Sarah Miller</h4>
                                <p class="text-sm text-gray-500">Director, HealthCare Plus</p>
                            </div>
                    </div>
                </div>

                    <!-- Testimonial 3 -->
                    <div class="bg-white rounded-3xl p-8 border border-gray-200 hover:border-gray-300 hover:shadow-lg transition-all duration-300">
                        <div class="flex items-center gap-1 mb-4">
                            <Star class="w-5 h-5 fill-yellow-400 text-yellow-400" />
                            <Star class="w-5 h-5 fill-yellow-400 text-yellow-400" />
                            <Star class="w-5 h-5 fill-yellow-400 text-yellow-400" />
                            <Star class="w-5 h-5 fill-yellow-400 text-yellow-400" />
                            <Star class="w-5 h-5 fill-yellow-400 text-yellow-400" />
                        </div>
                        <Quote class="w-8 h-8 text-blue-500 mb-4 opacity-50" />
                        <p class="text-gray-600 mb-6 leading-relaxed">
                            "Outstanding work on our logistics platform. The team understood our complex requirements and delivered a solution that streamlined our entire supply chain."
                        </p>
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 bg-gradient-to-r from-blue-500 to-purple-500 rounded-full flex items-center justify-center text-white font-bold">
                                MA
                            </div>
                            <div>
                                <h4 class="font-semibold text-gray-900">Michael Anderson</h4>
                                <p class="text-sm text-gray-500">CTO, FastLogistics</p>
                            </div>
                        </div>
                    </div>

                    <!-- Testimonial 4 -->
                    <div class="bg-white rounded-3xl p-8 border border-gray-200 hover:border-gray-300 hover:shadow-lg transition-all duration-300">
                        <div class="flex items-center gap-1 mb-4">
                            <Star class="w-5 h-5 fill-yellow-400 text-yellow-400" />
                            <Star class="w-5 h-5 fill-yellow-400 text-yellow-400" />
                            <Star class="w-5 h-5 fill-yellow-400 text-yellow-400" />
                            <Star class="w-5 h-5 fill-yellow-400 text-yellow-400" />
                            <Star class="w-5 h-5 fill-yellow-400 text-yellow-400" />
                        </div>
                        <Quote class="w-8 h-8 text-blue-500 mb-4 opacity-50" />
                        <p class="text-gray-600 mb-6 leading-relaxed">
                            "Their fintech solution helped us launch our digital wallet in record time. The security measures and user experience are top-notch."
                        </p>
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 bg-gradient-to-r from-blue-500 to-purple-500 rounded-full flex items-center justify-center text-white font-bold">
                                EW
                            </div>
                            <div>
                                <h4 class="font-semibold text-gray-900">Emily Wilson</h4>
                                <p class="text-sm text-gray-500">Founder, PayTech</p>
                            </div>
                        </div>
                    </div>

                    <!-- Testimonial 5 -->
                    <div class="bg-white rounded-3xl p-8 border border-gray-200 hover:border-gray-300 hover:shadow-lg transition-all duration-300">
                        <div class="flex items-center gap-1 mb-4">
                            <Star class="w-5 h-5 fill-yellow-400 text-yellow-400" />
                            <Star class="w-5 h-5 fill-yellow-400 text-yellow-400" />
                            <Star class="w-5 h-5 fill-yellow-400 text-yellow-400" />
                            <Star class="w-5 h-5 fill-yellow-400 text-yellow-400" />
                            <Star class="w-5 h-5 fill-yellow-400 text-yellow-400" />
                        </div>
                        <Quote class="w-8 h-8 text-blue-500 mb-4 opacity-50" />
                        <p class="text-gray-600 mb-6 leading-relaxed">
                            "The educational platform they developed has revolutionized how we deliver courses. Our students love the intuitive interface and seamless experience."
                        </p>
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 bg-gradient-to-r from-blue-500 to-purple-500 rounded-full flex items-center justify-center text-white font-bold">
                                RT
                            </div>
                            <div>
                                <h4 class="font-semibold text-gray-900">Robert Taylor</h4>
                                <p class="text-sm text-gray-500">Principal, EduTech Academy</p>
                            </div>
                        </div>
                    </div>

                    <!-- Testimonial 6 -->
                    <div class="bg-white rounded-3xl p-8 border border-gray-200 hover:border-gray-300 hover:shadow-lg transition-all duration-300">
                        <div class="flex items-center gap-1 mb-4">
                            <Star class="w-5 h-5 fill-yellow-400 text-yellow-400" />
                            <Star class="w-5 h-5 fill-yellow-400 text-yellow-400" />
                            <Star class="w-5 h-5 fill-yellow-400 text-yellow-400" />
                            <Star class="w-5 h-5 fill-yellow-400 text-yellow-400" />
                            <Star class="w-5 h-5 fill-yellow-400 text-yellow-400" />
                </div>
                        <Quote class="w-8 h-8 text-blue-500 mb-4 opacity-50" />
                        <p class="text-gray-600 mb-6 leading-relaxed">
                            "Working with iTab was a game-changer. Their cloud kitchen management system increased our order efficiency by 40%. Highly recommended!"
                        </p>
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 bg-gradient-to-r from-blue-500 to-purple-500 rounded-full flex items-center justify-center text-white font-bold">
                                LJ
                            </div>
                            <div>
                                <h4 class="font-semibold text-gray-900">Lisa Johnson</h4>
                                <p class="text-sm text-gray-500">Owner, CloudKitchen Pro</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Our Partners Section -->
        <section class="hidden py-20 px-4 bg-white">
            <div class="max-w-7xl mx-auto">
                <div class="text-center mb-16">
                    <h2 class="text-4xl md:text-6xl font-bold text-gray-900 mb-6">{{ t('partnersTitle') }}</h2>
                    <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                        {{ t('partnersSubtitle') }}
                    </p>
                        </div>

                <!-- Partners Grid -->
                <div v-if="partners.length > 0" class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 xl:grid-cols-6 gap-8 md:gap-12">
                    <div 
                        v-for="partner in partners" 
                        :key="partner.logo"
                        class="group flex items-center justify-center p-6 transition-all duration-300 hover:scale-110"
                    >
                        <img 
                            :src="partner.logo"
                            :alt="`${partner.name} logo`"
                            class="max-h-32 max-w-full object-contain opacity-80 group-hover:opacity-100 transition-all duration-300"
                            loading="lazy"
                        >
                        </div>
                    </div>
                <!-- Empty State -->
                <div v-else class="text-center py-12 text-gray-500">
                    <p>No company logos available yet.</p>
                </div>
                            
                <!-- Trust Badge -->
                <div class="text-center mt-12">
                    <div class="inline-flex items-center gap-2 bg-gray-100 backdrop-blur-sm rounded-full px-6 py-3 border border-gray-200">
                        <div class="w-2 h-2 bg-green-500 rounded-full animate-pulse"></div>
                        <span class="text-gray-700 text-xs font-medium">{{ t('partnersTrusted') }}</span>
            </div>
                    </div>
            </div>
        </section>

        <section class="hidden bg-white py-24">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <div class="mb-16 text-center">
                    <h2 class="mb-4 text-4xl font-bold text-gray-900 md:text-5xl">
                        لماذا تختارنا؟
                    </h2>
                    <p class="mx-auto max-w-2xl text-xl text-gray-600">
                        نتميز بمزايا فريدة تجعلنا الخيار الأمثل لشركتك
                    </p>
                </div>

                <div class="grid grid-cols-1 gap-8 lg:grid-cols-3">
                    <div
                        v-for="advantage in advantages"
                        :key="advantage.title"
                        class="group relative overflow-hidden rounded-3xl border border-gray-200 bg-white p-8 transition-all duration-300 hover:shadow-2xl"
                    >
                        <div class="absolute left-0 top-0 h-1 w-full bg-gradient-to-r" :class="advantage.gradient"></div>

                        <div
                            class="mb-6 flex h-20 w-20 items-center justify-center rounded-2xl bg-gradient-to-br transition-transform group-hover:scale-110"
                            :class="advantage.gradient"
                        >
                            <component :is="advantage.icon" class="h-9 w-9 text-white" />
                        </div>

                        <h3 class="mb-4 text-2xl font-bold text-gray-900">
                            {{ advantage.title }}
                        </h3>

                        <p class="mb-6 leading-relaxed text-gray-600">
                            {{ advantage.description }}
                        </p>

                        <div class="space-y-3">
                            <div
                                v-for="feature in advantage.features"
                                :key="feature"
                                class="flex items-center gap-2"
                            >
                                <CheckCircle class="h-5 w-5 shrink-0 text-green-500" />
                                <span class="text-gray-900">{{ feature }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-16 rounded-3xl bg-gradient-to-r from-blue-50 to-violet-50 p-12 text-center">
                    <h3 class="mb-4 text-3xl font-bold text-gray-900">
                        جاهز للبدء؟
                    </h3>
                    <p class="mx-auto mb-8 max-w-2xl text-xl text-gray-600">
                        انضم إلى +200 عميل راضٍ واستفد من خبرتنا في تطوير الحلول التقنية
                    </p>
                    <button
                        type="button"
                        class="rounded-xl bg-gradient-to-r from-blue-600 to-violet-600 px-10 py-4 text-white transition-all hover:shadow-2xl"
                        @click="scrollToSection('contact')"
                    >
                        احصل على استشارة مجانية
                    </button>
                </div>
            </div>
        </section>

        <section id="contact" class="bg-gradient-to-b from-slate-50 via-white to-slate-50 py-16 md:py-24">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <div class="mb-12 text-center md:mb-16">
                    <div class="mb-4 inline-flex items-center gap-2 rounded-full border border-blue-100 bg-blue-50 px-4 py-2 text-sm font-medium text-blue-700">
                        <span class="h-2 w-2 rounded-full bg-blue-500"></span>
                        <span>نحن هنا لخدمتك</span>
                    </div>
                    <h2 class="mb-4 text-3xl font-bold text-gray-900 sm:text-4xl md:text-5xl">
                        تواصل معنا
                    </h2>
                    <p class="mx-auto max-w-2xl text-base leading-7 text-gray-600 sm:text-lg md:text-xl">
                        نحن هنا للإجابة على جميع استفساراتك ومساعدتك في تحويل أفكارك إلى واقع
                    </p>
                </div>

                <div class="grid grid-cols-1 gap-8 lg:grid-cols-[0.95fr_1.05fr] xl:gap-12">
                    <div>
                        <div class="space-y-8">
                            <div>
                                <h3 class="mb-3 text-2xl font-bold text-gray-900">
                                    معلومات التواصل
                                </h3>
                                <p class="mb-6 max-w-lg text-base leading-7 text-gray-600">
                                    يمكنك التواصل معنا مباشرة عبر الهاتف أو البريد الإلكتروني، أو إرسال طلبك من خلال النموذج وسنعاود الرد عليك في أقرب وقت.
                                </p>

                                <div class="space-y-4">
                                    <div class="rounded-2xl border border-gray-200 bg-white p-5 shadow-sm">
                                        <div class="flex items-start gap-4">
                                            <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-xl bg-blue-100">
                                                <Phone class="h-6 w-6 text-blue-600" />
                                            </div>
                                            <div class="min-w-0">
                                                <div class="mb-1 text-sm font-semibold text-gray-500">الهاتف</div>
                                                <div class="text-base font-medium text-gray-900" dir="ltr">+966 53 581 5072</div>
                                                <div class="text-base font-medium text-gray-700" dir="ltr">+20 101 584 3432</div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="rounded-2xl border border-gray-200 bg-white p-5 shadow-sm">
                                        <div class="flex items-start gap-4">
                                            <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-xl bg-violet-100">
                                                <Mail class="h-6 w-6 text-violet-600" />
                                            </div>
                                            <div class="min-w-0">
                                                <div class="mb-1 text-sm font-semibold text-gray-500">البريد الإلكتروني</div>
                                                <div class="text-base font-medium text-gray-900" dir="ltr">info@itap-tech.com</div>
                                                <div class="text-base font-medium text-gray-700" dir="ltr">marketing@itap-tech.com</div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="rounded-2xl border border-gray-200 bg-white p-5 shadow-sm">
                                        <div class="flex items-start gap-4">
                                            <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-xl bg-green-100">
                                                <MapPin class="h-6 w-6 text-green-600" />
                                            </div>
                                            <div class="min-w-0">
                                                <div class="mb-1 text-sm font-semibold text-gray-500">المكاتب</div>
                                                <div class="text-base font-medium text-gray-900">الرياض، المملكة العربية السعودية</div>
                                                <div class="text-base font-medium text-gray-700">القاهرة، جمهورية مصر العربية</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="rounded-3xl border border-blue-100 bg-gradient-to-br from-blue-50 via-white to-violet-50 p-6 shadow-sm md:p-8">
                                <div class="mb-5">
                                    <div>
                                        <h4 class="text-xl font-bold text-gray-900">
                                            ساعات العمل
                                        </h4>
                                        <p class="mt-1 text-sm text-gray-600">
                                            متواجدون للرد على استفساراتك خلال أيام العمل والدعم الفني متاح دائمًا.
                                        </p>
                                    </div>
                                </div>
                                <div class="space-y-3 text-gray-700">
                                    <div class="flex flex-col gap-1 rounded-2xl bg-white/80 px-4 py-3 sm:flex-row sm:items-center sm:justify-between">
                                        <span class="font-medium">السبت - الخميس</span>
                                        <span dir="ltr" class="text-sm font-semibold text-gray-900 sm:text-base">9:00 ص - 6:00 م</span>
                                    </div>
                                    <div class="flex flex-col gap-1 rounded-2xl bg-white/80 px-4 py-3 sm:flex-row sm:items-center sm:justify-between">
                                        <span class="font-medium">الجمعة</span>
                                        <span class="text-sm font-semibold text-gray-900 sm:text-base">مغلق</span>
                                    </div>
                                    <div class="flex flex-col gap-1 rounded-2xl bg-white/80 px-4 py-3 sm:flex-row sm:items-center sm:justify-between">
                                        <span class="font-medium">الدعم الفني</span>
                                        <span dir="ltr" class="text-sm font-semibold text-gray-900 sm:text-base">24/7</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div>
                        <form class="rounded-3xl border border-gray-200 bg-white p-6 shadow-[0_20px_60px_rgba(15,23,42,0.08)] md:p-8" @submit.prevent="handleContactSubmit">
                            <div class="mb-8 border-b border-gray-100 pb-6">
                                <h3 class="text-2xl font-bold text-gray-900">أرسل لنا رسالتك</h3>
                                <p class="mt-2 text-base leading-7 text-gray-600">
                                    شاركنا فكرتك أو احتياجك التقني وسيتواصل معك فريقنا بالحل المناسب خلال وقت قصير.
                                </p>
                            </div>

                            <div class="space-y-6">
                                <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                                    <div>
                                        <label for="contact-name" class="mb-2 block text-sm font-semibold text-gray-800">
                                            الاسم الكامل *
                                        </label>
                                        <input
                                            id="contact-name"
                                            v-model="contactForm.name"
                                            type="text"
                                            required
                                            class="w-full rounded-xl border border-gray-200 bg-gray-50 px-4 py-3.5 transition-all focus:border-blue-500 focus:bg-white focus:outline-none focus:ring-4 focus:ring-blue-100"
                                            placeholder="أدخل اسمك الكامل"
                                        />
                                    </div>

                                    <div>
                                        <label for="contact-phone" class="mb-2 block text-sm font-semibold text-gray-800">
                                            رقم الهاتف *
                                        </label>
                                        <input
                                            id="contact-phone"
                                            v-model="contactForm.phone"
                                            type="tel"
                                            required
                                            dir="ltr"
                                            class="w-full rounded-xl border border-gray-200 bg-gray-50 px-4 py-3.5 transition-all focus:border-blue-500 focus:bg-white focus:outline-none focus:ring-4 focus:ring-blue-100"
                                            placeholder="+966 53 581 5072"
                                        />
                                    </div>
                                </div>

                                <div>
                                    <label for="contact-email" class="mb-2 block text-sm font-semibold text-gray-800">
                                        البريد الإلكتروني *
                                    </label>
                                    <input
                                        id="contact-email"
                                        v-model="contactForm.email"
                                        type="email"
                                        required
                                        dir="ltr"
                                        class="w-full rounded-xl border border-gray-200 bg-gray-50 px-4 py-3.5 transition-all focus:border-blue-500 focus:bg-white focus:outline-none focus:ring-4 focus:ring-blue-100"
                                        placeholder="example@email.com"
                                    />
                                </div>

                                <div>
                                    <label for="contact-company" class="mb-2 block text-sm font-semibold text-gray-800">
                                        اسم الشركة
                                    </label>
                                    <input
                                        id="contact-company"
                                        v-model="contactForm.company"
                                        type="text"
                                        class="w-full rounded-xl border border-gray-200 bg-gray-50 px-4 py-3.5 transition-all focus:border-blue-500 focus:bg-white focus:outline-none focus:ring-4 focus:ring-blue-100"
                                        placeholder="اسم شركتك (اختياري)"
                                    />
                                </div>

                                <div>
                                    <label for="contact-message" class="mb-2 block text-sm font-semibold text-gray-800">
                                        الرسالة *
                                    </label>
                                    <textarea
                                        id="contact-message"
                                        v-model="contactForm.message"
                                        required
                                        rows="6"
                                        class="w-full resize-none rounded-xl border border-gray-200 bg-gray-50 px-4 py-3.5 transition-all focus:border-blue-500 focus:bg-white focus:outline-none focus:ring-4 focus:ring-blue-100"
                                        placeholder="اكتب رسالتك هنا..."
                                    ></textarea>
                                </div>

                                <button
                                    type="submit"
                                    class="group flex w-full items-center justify-center gap-2 rounded-xl bg-gradient-to-r from-blue-600 to-violet-600 px-8 py-4 text-base font-semibold text-white transition-all hover:shadow-2xl"
                                >
                                    <span>إرسال الرسالة</span>
                                    <Send class="h-5 w-5 transition-transform group-hover:translate-x-1" />
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>

        <footer class="bg-slate-900 text-white">
            <div class="mx-auto max-w-7xl px-4 py-12 sm:px-6 lg:px-8">
                <div class="mb-8 grid grid-cols-1 gap-8 md:grid-cols-2 lg:grid-cols-4">
                    <div class="text-center lg:text-right">
                        <div class="mb-4 flex items-center justify-center lg:justify-start">
                            <img
                                src="/asset/Black_White_Minimal_Modern_Simple_Bold_Business_Mag_Logo__1_-removebg-preview.png"
                                alt="iTab Logo"
                                class="h-12 w-auto"
                            />
                        </div>

                        <p class="mb-4 leading-relaxed text-gray-300">
                            نقدم حلولاً تقنية متكاملة للشركات والمؤسسات في السعودية ومصر مع التركيز على الجودة والابتكار
                        </p>

                        <div class="flex justify-center gap-3 lg:justify-start">
                            <a
                                href="https://www.facebook.com/profile.php?id=61585174361896"
                                target="_blank"
                                rel="noopener noreferrer"
                                class="flex h-10 w-10 items-center justify-center rounded-lg bg-white/10 transition-colors hover:bg-white/20"
                            >
                                <Facebook class="h-5 w-5" />
                            </a>
                            <a
                                href="https://x.com"
                                target="_blank"
                                rel="noopener noreferrer"
                                class="flex h-10 w-10 items-center justify-center rounded-lg bg-white/10 transition-colors hover:bg-white/20"
                            >
                                <Twitter class="h-5 w-5" />
                            </a>
                            <a
                                href="https://www.linkedin.com/company/itap-solution"
                                target="_blank"
                                rel="noopener noreferrer"
                                class="flex h-10 w-10 items-center justify-center rounded-lg bg-white/10 transition-colors hover:bg-white/20"
                            >
                                <Linkedin class="h-5 w-5" />
                            </a>
                            <a
                                href="https://www.instagram.com/itap_solution/"
                                target="_blank"
                                rel="noopener noreferrer"
                                class="flex h-10 w-10 items-center justify-center rounded-lg bg-white/10 transition-colors hover:bg-white/20"
                            >
                                <Instagram class="h-5 w-5" />
                            </a>
                        </div>
                    </div>

                    <div class="text-center lg:text-right">
                        <h3 class="mb-4 text-lg font-bold">الخدمات</h3>
                        <ul class="space-y-2 text-gray-300">
                            <li><button type="button" class="transition-colors hover:text-white" @click="scrollToSection('services')">تطوير المواقع</button></li>
                            <li><button type="button" class="transition-colors hover:text-white" @click="scrollToSection('services')">تطبيقات الموبايل</button></li>
                            <li><button type="button" class="transition-colors hover:text-white" @click="scrollToSection('services')">أنظمة الشركات</button></li>
                            <li><button type="button" class="transition-colors hover:text-white" @click="scrollToSection('services')">الذكاء الاصطناعي</button></li>
                            <li><button type="button" class="transition-colors hover:text-white" @click="scrollToSection('services')">تحليل البيانات</button></li>
                        </ul>
                    </div>

                    <div class="text-center lg:text-right">
                        <h3 class="mb-4 text-lg font-bold">روابط سريعة</h3>
                        <ul class="space-y-2 text-gray-300">
                            <li><button type="button" class="transition-colors hover:text-white" @click="scrollToSection('hero')">الرئيسية</button></li>
                            <li><button type="button" class="transition-colors hover:text-white" @click="scrollToSection('services')">الخدمات</button></li>
                            <li><button type="button" class="transition-colors hover:text-white" @click="scrollToSection('industries')">القطاعات</button></li>
                            <li><button type="button" class="transition-colors hover:text-white" @click="scrollToSection('portfolio')">الأعمال</button></li>
                            <li><button type="button" class="transition-colors hover:text-white" @click="scrollToSection('contact')">تواصل معنا</button></li>
                        </ul>
                    </div>

                    <div class="text-center lg:text-right">
                        <h3 class="mb-4 text-lg font-bold">تواصل معنا</h3>
                        <ul class="space-y-3 text-gray-300">
                            <li class="flex items-start justify-center gap-2 lg:justify-start">
                                <Phone class="mt-1 h-5 w-5 shrink-0" />
                                <div>
                                    <div dir="ltr">+966 53 581 5072</div>
                                    <div dir="ltr">+20 100 123 4567</div>
                                </div>
                            </li>
                            <li class="flex items-start justify-center gap-2 lg:justify-start">
                                <Mail class="mt-1 h-5 w-5 shrink-0" />
                                <div dir="ltr">info@itapsolution.com</div>
                            </li>
                            <li class="flex items-start justify-center gap-2 lg:justify-start">
                                <MapPin class="mt-1 h-5 w-5 shrink-0" />
                                <div>
                                    <div>الرياض، السعودية</div>
                                    <div>القاهرة، مصر</div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="border-t border-white/10 pt-8">
                    <div class="flex flex-col items-center justify-between gap-4 text-sm text-gray-300 md:flex-row">
                        <div>
                            © {{ currentYear }} تِك سوليوشنز. جميع الحقوق محفوظة.
                        </div>

                        <div class="flex flex-wrap items-center justify-center gap-6">
                            <Link href="/privacy-policy" class="transition-colors hover:text-white">سياسة الخصوصية</Link>
                            <Link href="/user-data-deletion" class="transition-colors hover:text-white">حذف البيانات</Link>
                            <Link href="/contact-us" class="transition-colors hover:text-white">تواصل معنا</Link>
                        </div>
                    </div>
                </div>
            </div>
        </footer>

        <!-- WhatsApp Button -->
        <a href="https://wa.me/966535815072" target="_blank" rel="noopener noreferrer"
           class="fixed bottom-6 right-6 md:bottom-6 md:right-6 sm:bottom-4 sm:right-4 z-50 bg-green-500 hover:bg-green-600 text-white rounded-full p-4 md:p-6 shadow-lg transition-all duration-300 hover:scale-110"
           style="z-index: 9999; width: 64px; height: 64px; display: flex; align-items: center; justify-content: center;">
            <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 24 24">
                <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/>
            </svg>
        </a>
    </div>
</template>

<style scoped>
@keyframes float {
    0%, 100% { transform: translateY(0px); }
    50% { transform: translateY(-10px); }
}

.animate-float {
    animation: float 3s ease-in-out infinite;
}

/* Hero Animations */
@keyframes orb-1 {
    0%, 100% { 
        transform: scale(1) translate(0, 0); 
    }
    50% { 
        transform: scale(1.2) translate(50px, 30px); 
    }
}

@keyframes orb-2 {
    0%, 100% { 
        transform: scale(1) translate(0, 0); 
    }
    50% { 
        transform: scale(1.3) translate(-50px, -30px); 
    }
}

@keyframes orb-3 {
    0%, 100% { 
        transform: scale(1) rotate(0deg); 
    }
    50% { 
        transform: scale(1.4) rotate(180deg); 
    }
    100% {
        transform: scale(1) rotate(360deg);
    }
}

@keyframes fade-in-up {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

@keyframes scale-in {
    from {
        opacity: 0;
        transform: scale(0.8);
    }
    to {
        opacity: 1;
        transform: scale(1);
    }
}

@keyframes card-float {
    0%, 100% { 
        transform: translateY(0); 
    }
    50% { 
        transform: translateY(-20px); 
    }
}

@keyframes float-icon {
    0%, 100% { 
        transform: translate(0, 0) rotate(0deg);
        opacity: 1;
    }
    33% { 
        transform: translate(20px, -20px) rotate(120deg);
        opacity: 0.9;
    }
    66% { 
        transform: translate(-20px, 20px) rotate(240deg);
        opacity: 0.9;
    }
}

.code-line {
    width: 0%;
    animation: code-line-expand 1.5s ease-out forwards, code-line-pulse 3s ease-in-out infinite;
    animation-delay: var(--delay, 0.5s), var(--pulse-delay, 2s);
}

@keyframes code-line-expand {
    from {
        width: 0%;
    }
    to {
        width: var(--target-width, 60%);
    }
}

@keyframes code-line-pulse {
    0%, 100% {
        opacity: 1;
    }
    50% {
        opacity: 0.6;
    }
}

@keyframes badge-float-1 {
    0%, 100% { 
        transform: translateY(0); 
    }
    50% { 
        transform: translateY(-10px); 
    }
}

@keyframes badge-float-2 {
    0%, 100% { 
        transform: translateY(0); 
    }
    50% { 
        transform: translateY(10px); 
    }
}

@keyframes scroll-indicator {
    0%, 100% { 
        transform: translate(-50%, 0); 
    }
    50% { 
        transform: translate(-50%, 10px); 
    }
}

@keyframes scroll-dot {
    0%, 100% { 
        transform: translateY(0);
        opacity: 1;
    }
    50% { 
        transform: translateY(12px);
        opacity: 0.3;
    }
}

.animate-orb-1 {
    animation: orb-1 8s ease-in-out infinite;
}

.animate-orb-2 {
    animation: orb-2 10s ease-in-out infinite;
}

.animate-orb-3 {
    animation: orb-3 12s ease-in-out infinite;
}

.animate-fade-in-up {
    animation: fade-in-up 0.8s ease-out forwards;
}

.animate-fade-in-up-delay-1 {
    animation: fade-in-up 0.8s ease-out 0.2s forwards;
    opacity: 0;
}

.animate-fade-in-up-delay-2 {
    animation: fade-in-up 0.8s ease-out 0.4s forwards;
    opacity: 0;
}

.animate-fade-in-up-delay-3 {
    animation: fade-in-up 0.8s ease-out 0.6s forwards;
    opacity: 0;
}

.animate-scale-in {
    animation: scale-in 1s ease-out 0.3s forwards;
    opacity: 0;
}

.animate-card-float {
    animation: card-float 4s ease-in-out infinite;
}

.animate-badge-float-1 {
    animation: badge-float-1 3s ease-in-out infinite;
}

.animate-badge-float-2 {
    animation: badge-float-2 3s ease-in-out 1.5s infinite;
}

.animate-scroll-indicator {
    animation: scroll-indicator 2s ease-in-out infinite;
}

.animate-scroll-dot {
    animation: scroll-dot 2s ease-in-out infinite;
}

/* Services Animations */
.service-card {
    opacity: 0;
    transform: translateY(30px);
    animation: service-fade-in-up 0.6s ease-out forwards;
}

@keyframes service-fade-in-up {
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Projects Animations */
.project-card {
    opacity: 0;
    transform: translateY(30px);
    animation: project-fade-in-up 0.6s ease-out forwards;
}

@keyframes project-fade-in-up {
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* App Section Animations */
.app-section-left {
    opacity: 0;
    transform: translateX(-30px);
    animation: slide-in-left 0.8s ease-out forwards;
}

.app-section-right {
    opacity: 0;
    transform: translateX(30px);
    animation: slide-in-right 0.8s ease-out forwards;
}

@keyframes slide-in-left {
    to {
        opacity: 1;
        transform: translateX(0);
    }
}

@keyframes slide-in-right {
    to {
        opacity: 1;
        transform: translateX(0);
    }
}

.animate-slide-in-left {
    opacity: 0;
    transform: translateX(-30px);
    animation: slide-in-left 0.8s ease-out forwards;
}

.animate-slide-in-right {
    opacity: 0;
    transform: translateX(30px);
    animation: slide-in-right 0.8s ease-out forwards;
}

.website-section-left,
.website-section-right {
    animation-delay: 0.2s;
}

/* Goals Animations */
.goal-item {
    opacity: 0;
    transform: scale(0.8);
    animation: goal-scale-in 0.6s ease-out forwards;
}

@keyframes goal-scale-in {
    to {
        opacity: 1;
        transform: scale(1);
    }
}

/* About Features Animations */
.about-feature-card {
    opacity: 0;
    transform: translateY(30px);
    animation: feature-fade-in-up 0.6s ease-out forwards;
}

@keyframes feature-fade-in-up {
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Custom scrollbar for the modal */
::-webkit-scrollbar {
    width: 6px;
}

::-webkit-scrollbar-track {
    background: rgba(255, 255, 255, 0.1);
    border-radius: 3px;
}

::-webkit-scrollbar-thumb {
    background: rgba(59, 130, 246, 0.5);
    border-radius: 3px;
}

::-webkit-scrollbar-thumb:hover {
    background: rgba(59, 130, 246, 0.7);
}

</style>
