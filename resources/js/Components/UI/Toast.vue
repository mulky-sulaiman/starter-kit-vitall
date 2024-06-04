<script setup>
import { usePage } from '@inertiajs/vue3'
import { toast } from 'vue3-toastify'
import 'vue3-toastify/dist/index.css'

/**
 * Array variable to store options for vue3-toastify
 * @var array
 */
const options = {
    'theme': toast.THEME.AUTO,
    'dangerouslyHTMLString': true,
    'position': toast.POSITION.TOP_RIGHT,
    'autoClose': 2000,
    'closeOnClick': true,
    'type': toast.TYPE.DEFAULT
}
/**
 * To store passed values to display notification without Laravel's Flash Message
*/
const props = defineProps({
    type: String,
    message: String,
})

/**
 * Laravel's Flash Message Object
 * @var Object
*/
const flash = usePage().props.flash
/**
 * Main function to trigger toast notification
 * @param string type
 * @param string message
*/
const notify = (type, message) => {

    // Setting : Notification type e.g success, error, warning or info
    options['type'] = type
    // Fire the notification
    toast(message, options)
}
/**
 * Trigger toast notification if success message is present
*/
if (flash.success) {
    notify(toast.TYPE.SUCCESS, flash.success)
}
/**
 * Trigger toast notification if error message is present
*/
if (flash.error) {
    notify(toast.TYPE.ERROR, flash.error)
}
/**
 * Trigger toast notification if warning message is present
*/
if (flash.warning) {
    notify(toast.TYPE.WARNING, flash.error)
}
/**
 * Trigger toast notification if info message is present
*/
if (flash.info) {
    notify(toast.TYPE.INFO, flash.info)
}

/**
 * Trigger direct toast notification if message values being passed
*/
if (props.message) {
    notify(props.type, props.message)
}
</script>
