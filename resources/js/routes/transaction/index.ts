import { queryParams, type RouteQueryOptions, type RouteDefinition } from './../../wayfinder'
/**
* @see \App\Http\Controllers\TransactionController::store
 * @see app/Http/Controllers/TransactionController.php:9
 * @route '/transactions'
 */
export const store = (options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: store.url(options),
    method: 'post',
})

store.definition = {
    methods: ["post"],
    url: '/transactions',
} satisfies RouteDefinition<["post"]>

/**
* @see \App\Http\Controllers\TransactionController::store
 * @see app/Http/Controllers/TransactionController.php:9
 * @route '/transactions'
 */
store.url = (options?: RouteQueryOptions) => {
    return store.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\TransactionController::store
 * @see app/Http/Controllers/TransactionController.php:9
 * @route '/transactions'
 */
store.post = (options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: store.url(options),
    method: 'post',
})
const transaction = {
    store: Object.assign(store, store),
}

export default transaction