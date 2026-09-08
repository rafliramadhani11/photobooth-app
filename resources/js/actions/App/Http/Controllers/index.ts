import EventController from './EventController'
import TransactionController from './TransactionController'
const Controllers = {
    EventController: Object.assign(EventController, EventController),
TransactionController: Object.assign(TransactionController, TransactionController),
}

export default Controllers