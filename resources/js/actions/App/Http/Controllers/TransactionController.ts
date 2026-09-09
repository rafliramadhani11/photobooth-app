import { queryParams, type RouteQueryOptions, type RouteDefinition, applyUrlDefaults } from './../../../../wayfinder'
/**
* @see \App\Http\Controllers\TransactionController::store
 * @see app/Http/Controllers/TransactionController.php:21
 * @route '/transaction/{event}/{package}/checkout'
 */
export const store = (args: { event: number | { id: number }, package: number | { id: number } } | [event: number | { id: number }, packageParam: number | { id: number } ], options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: store.url(args, options),
    method: 'post',
})

store.definition = {
    methods: ["post"],
    url: '/transaction/{event}/{package}/checkout',
} satisfies RouteDefinition<["post"]>

/**
* @see \App\Http\Controllers\TransactionController::store
 * @see app/Http/Controllers/TransactionController.php:21
 * @route '/transaction/{event}/{package}/checkout'
 */
store.url = (args: { event: number | { id: number }, package: number | { id: number } } | [event: number | { id: number }, packageParam: number | { id: number } ], options?: RouteQueryOptions) => {
    if (Array.isArray(args)) {
        args = {
                    event: args[0],
                    package: args[1],
                }
    }

    args = applyUrlDefaults(args)

    const parsedArgs = {
                        event: typeof args.event === 'object'
                ? args.event.id
                : args.event,
                                package: typeof args.package === 'object'
                ? args.package.id
                : args.package,
                }

    return store.definition.url
            .replace('{event}', parsedArgs.event.toString())
            .replace('{package}', parsedArgs.package.toString())
            .replace(/\/+$/, '') + queryParams(options)
}

/**
* @see \App\Http\Controllers\TransactionController::store
 * @see app/Http/Controllers/TransactionController.php:21
 * @route '/transaction/{event}/{package}/checkout'
 */
store.post = (args: { event: number | { id: number }, package: number | { id: number } } | [event: number | { id: number }, packageParam: number | { id: number } ], options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: store.url(args, options),
    method: 'post',
})
const TransactionController = { store }

export default TransactionController