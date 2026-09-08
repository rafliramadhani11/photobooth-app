import { queryParams, type RouteQueryOptions, type RouteDefinition } from './../../../../wayfinder'
/**
* @see \App\Http\Controllers\EventController::welcome
 * @see app/Http/Controllers/EventController.php:11
 * @route '/'
 */
export const welcome = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: welcome.url(options),
    method: 'get',
})

welcome.definition = {
    methods: ["get","head"],
    url: '/',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \App\Http\Controllers\EventController::welcome
 * @see app/Http/Controllers/EventController.php:11
 * @route '/'
 */
welcome.url = (options?: RouteQueryOptions) => {
    return welcome.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\EventController::welcome
 * @see app/Http/Controllers/EventController.php:11
 * @route '/'
 */
welcome.get = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: welcome.url(options),
    method: 'get',
})
/**
* @see \App\Http\Controllers\EventController::welcome
 * @see app/Http/Controllers/EventController.php:11
 * @route '/'
 */
welcome.head = (options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: welcome.url(options),
    method: 'head',
})
const EventController = { welcome }

export default EventController