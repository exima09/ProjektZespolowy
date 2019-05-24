import { Prisoner } from "../prisoner/prisoner.model";
import { Worker } from "../worker/worker.model";

export class Execution {
    id?: number;
    worker: Worker;
    prisoner: Prisoner;
    executionDate: string;
    lastWish: string;
}
