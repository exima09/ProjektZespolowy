import {Worker} from "../worker/worker.model";

export class News {
  id?: number;
  title: string;
  text: string;
  image: string;
  dateAdded: string;
  worker: Worker;
}
