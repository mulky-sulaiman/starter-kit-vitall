import { ref } from "vue"
import { defineStore } from "pinia"

export const useConfirmDialogStore = defineStore('confirmDialogStore', () => {
    // States
    let key = ref(null)
    let type = ref('warning')
    let size = ref('md')
    let useIcon = ref(true)
    let headTitle = ref('Confirmation Needed')
    let title = ref('Are you sure you want to do this operation?')
    let message = ref('Click OK to continue, or CANCEL to abort the operation')
    let useCancel = ref(true)
    let labelCancel = ref('CANCEL')
    let useOk = ref(true)
    let labelOk = ref('OK')
    let placement = ref('left')
    let target = ref(null)
    let isConfirmed = ref(false)
    // Getters
    const isValidConfirmation = (valueToWatch) => {
        return isConfirmed.value && target.value === valueToWatch
    }
    // Actions
    function set(params) {
        if (params.key) { key.value = params.key }
        if (params.type) { type.value = params.type }
        if (params.size) { size.value = params.size }
        if (params.useIcon) { useIcon.value = params.useIcon }
        if (params.headTitle) { headTitle.value = params.headTitle }
        if (params.title) { title.value = params.title }
        if (params.message) { message.value = params.message }
        if (params.useCancel) { useCancel.value = params.useCancel }
        if (params.labelCancel) { labelCancel.value = params.labelCancel }
        if (params.useOk) { useOk.value = params.useOk }
        if (params.labelOk) { labelOk.value = params.labelOk }
        if (params.placement) { placement.value = params.placement }
        if (params.target) { target.value = params.target }
        if (params.isConfirmed) { isConfirmed.value = params.isConfirmed }
    }
    function $reset() {
        key.value = null
        type.value = 'warning'
        size.value = 'md'
        useIcon.value = true
        headTitle.value = 'Confirmation Needed'
        title.value = 'Are you sure you want to do this operation?'
        message.value = 'Click OK to continue, or CANCEL to abort the operation'
        useCancel.value = true
        labelCancel.value = 'CANCEL'
        useOk.value = true
        labelOk.value = 'OK'
        placement.value = 'left'
        target.value = null
        isConfirmed.value = false
    }

    return {
        key,
        type,
        size,
        useIcon,
        headTitle,
        title,
        message,
        useCancel,
        labelCancel,
        useOk,
        labelOk,
        placement,
        target,
        isConfirmed,
        isValidConfirmation,
        set,
        $reset
    }
})
