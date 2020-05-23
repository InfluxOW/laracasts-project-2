<template>
    <div class="dropdown">
        <div class="dropdown-toggle"
             aria-haspopup="true"
             :aria-expanded="isOpen"
             @click.prevent="isOpen = !isOpen"
        >
            <slot name="trigger"></slot>
        </div>

        <div v-show="isOpen"
             class="dropdown-menu bg-card py-1 rounded shadow-custom mt-4 absolute"
             :class="align === 'left' ? 'left-0' : 'right-0'"
             :style="{ width }"
        >
            <slot></slot>
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            align: { default: 'left' },
            width: { default: 'auto' }
        },
        data() {
            return { isOpen: false }
        },
        watch: {
            isOpen(isOpen) {
                if (isOpen) {
                    document.addEventListener('click', this.closeIfClickedOutside);
                }
            }
        },
        methods: {
            closeIfClickedOutside(event) {
                if (! event.target.closest('.dropdown')) {
                    this.isOpen = false;
                    document.removeEventListener('click', this.closeIfClickedOutside);
                }
            }
        }
    }
</script>
